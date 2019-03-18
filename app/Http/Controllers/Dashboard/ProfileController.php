<?php

namespace App\Http\Controllers\Dashboard;

use App\Notifications\ProfileUpdated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller
{
    //
    public function index(Request $request, $id=null){
        $user_id = $request->user()->id;
        if($id){
            //super admin checking profile of a sub user
            if($request->user()->role == 1){
                $user_id = $id;
            }
        }

        $found_user = User::find($user_id);
        if($found_user){
            return view('dashboard.profile.home', [
                'page_title'=>'View Profile : '.$found_user->name,
                'found_user'=>$found_user,
                'id'=>$id
            ]);
        }
        return redirect(route('home'))->withErrors([
            'You do not have enough Privilege to perform this operation'
        ]);

    }

    public function edit(Request $request){
        return view('dashboard.profile.edit', [
            'page_title'=>'Edit My Profile',
            'found_user'=>$request->user(),
            'id'=>null
        ]);
    }

    public function change_password(Request $request){
        return view('dashboard.profile.change_password', [
            'page_title'=>'Change My Password',
            'found_user'=>$request->user(),
            'id'=>null
        ]);
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        try{
            $user = $request->user();
            User::find($user->id)->update($validatedData);
            $user->notify(new ProfileUpdated($user->name));
        }
        catch (QueryException $qe){
            return back()->withErrors(['err'=>$qe->getPrevious()->getMessage()]);
        }

        return back()->withInput(['success'=>true]);
    }

    public function update_change_password(Request $request){
        $validatedData = $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);
        try{
            $user = $request->user();
            $validatedData['password'] = bcrypt($validatedData['password']);
            User::find($user->id)->update($validatedData);
            $user->notify(new ProfileUpdated($user->name));
        }
        catch (QueryException $qe){
            return back()->withErrors(['err'=>$qe->getPrevious()->getMessage()]);
        }

        return back()->withInput(['success'=>true]);
    }
}
