<?php

namespace App\Http\Controllers\Dashboard;

use App\Core\Helpers;
use App\Notifications\AdminInvite;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDataTable;
use App\User;
use App\Office;
use DB;
use Charts;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
//    public function index(Request $request){
//		$values = User::select('jetties.name as jetty', DB::raw('count(home_jetty) AS users'))
//		->leftJoin('jetties', 'users.home_jetty', 'jetties.id')
//		->groupBy('home_jetty')
//		->get();
//		$chart = Charts::create('bar', 'highcharts')
//        ->title('Jetty Users')
//        ->elementLabel('People')
//        ->labels($values->pluck('jetty'))
//        ->values($values->pluck('users'))
//        ->responsive(false);
//        return view('dashboard.admin.home', [
//            'page_title'=>'Admin Users','chart'=>$chart
//        ]);
//    }

    public function add(AdminDataTable $dataTable, $user_id=null){
//        dd(request()->route()->parameter('id'));
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.admin.add', [
            'page_title'=>'Users Management',

            'user'=> $user_id?User::find($user_id):null
        ]);
    }
    public function manage(AdminDataTable $dataTable, $user_id=null){
//        dd(request()->route()->parameter('id'));
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.admin.manage', [
            'page_title'=>'Users Management',
            
            'user'=> $user_id?User::find($user_id):null
        ]);
    }

    public function invite_update(Request $request, $id=null){
        $email_validation_append = is_null($id)?'|unique:users,email':'';
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'.$email_validation_append,
            'password' => $id?'nullable':'required|string|min:6|confirmed',
            'role'=> 'required|integer|not_in:1',
//			'operator'=> 'required|exists:operators,id',
//            'home_jetty'=> 'nullable|exists:jetties,id'
        ]);

        if($id){
            try{
                unset($validatedData['password']);
                User::find($id)->update($validatedData);
            }
            catch (QueryException $qe){
                return back()->withErrors(['err'=>$qe->getPrevious()->getMessage()]);
            }
        }
        else {
            $user = $this->create($validatedData);
//            event(new Registered($user));
//            $user->notify(new AdminInvite($validatedData['password']));
        }

        return back()->withInput(['success'=>true]);
    }

    public function suspend_unsuspend(Request $request, $id){
        $user = User::find($id);
        if($user){
            $user->active = !$user->active;
            $user->save();
            return redirect(route('admin.manage'))->withInput(['success'=>true]);
        }
        return back()->withErrors(['err'=>'User not found or does not exist']);
    }

    private function create($data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
//			'operator'=>$data['operator'],
//            'home_jetty' => $data['home_jetty']
        ]);
    }
}
