<?php

namespace App\Http\Controllers\Api;
use App\DataTables\PeopleDataTable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Returns;
use App\Jetty;
use Response;
use Validator;

class JettyController extends Controller
{
	public function get_all()
	{
		$jetties=Jetty::all();
		return Response::json(Returns::ok($jetties));
	}

	public function get_by_operator(Request $request, $operator){
		$jetties = Jetty::where('operator', $operator)->get();
		return Response::json(Returns::ok($jetties));
	}
	public function get(Request $request, $id)
	{
		$jetty = Jetty::find($id);
		return Response::json(Returns::ok($jetty));
	}
}