<?php

namespace App\Http\Controllers\Api;
use App\DataTables\PeopleDataTable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Returns;
use App\User;
use Response;
use Validator;

class UserController extends Controller
{
	public function get_all()
	{
		$users=User::all();
		return Response::json(Returns::ok($users));
	}

	public function get_by_home_jetty(Request $request, $home_jetty){
		$users = User::where('home_jetty', $home_jetty)->get();
		return Response::json(Returns::ok($users));
	}
	public function get_by_operator(Request $request, $operator){
		$users = User::where('operator', $operator)->get();
		return Response::json(Returns::ok($users));
	}
	public function get(Request $request, $id)
	{
		$user = User::find($id);
		return Response::json(Returns::ok($user));
	}
}