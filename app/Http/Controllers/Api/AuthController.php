<?php

namespace App\Http\Controllers\Api;

use App\Core\Helpers;
use App\Core\Returns;
use App\Http\Controllers\Controller;
use App\Core\Requests\LoginProxy;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\Auth\InvalidIdToken;
use Validator;
use App\Core\FirebaseHelper;
use App\User;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private $loginProxy;

    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
    }

    public function login(Request $request){
        $validator = Validator::make($request->only(['email', 'password']),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails()){
            return Returns::validationError($validator->errors());
        }
        return $this->loginProxy->attemptLogin($request->input('email'),
            $request->input('password'), 'monitor');
    }

    public function get(Request $request){
        return response()->json(collect($request->user())->only(['id','name', 'email', 'operator', 'jome_jetty','role', 'picture', 'created_at'])->toArray());
    }

    public function refresh(Request $request){
        return $this->loginProxy->attemptRefresh($request->bearerToken());
    }

    public function register_auth(Request $request){
        $firebase = new FirebaseHelper();
        try{
            $user = $firebase->verifyToken($request->input('token'));
            //Helpers::logDNA($user->toArray());
            //check user if in database
            $this->updateUser($user);
            return $this->loginProxy->attemptLogin($user->get('email'),
                $user->get('user_id'), 'evaluate');
        }
        catch (InvalidIdToken $invalidIdToken){
            return Returns::validationError($invalidIdToken->getMessage());
        }
    }

    public function logout(Request $request){
        $this->loginProxy->logout($request->bearerToken());
        return Returns::ok([]);
    }

    public function firebase_token(Request $request){
        $user = User::find($request->user()->id);
        $user->firebase_token = $request->input('firebase_token');
        $user->save();
        return Returns::ok($user);
    }

    private function updateUser($user){
        User::updateOrCreate( [
            'email'=>$user->get('email')
        ],[
            'name' => $user->get('name'),
            'password' => bcrypt($user->get('user_id')),
            'picture' => $user->get('picture'),
        ]);
    }
}
