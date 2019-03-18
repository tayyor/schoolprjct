<?php

namespace App\Http\Controllers\Api;
use App\DataTables\PeopleDataTable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Returns;
use App\Boat;
use Response;
use Validator;

class BoatController extends Controller
{
	public function get_all()
	{
		$boats=Boat::all();
		return Response::json(Returns::ok($boats));
	}

	public function get_by_home_jetty(Request $request, $home_jetty){
		$boats = Boat::where('home_jetty', $home_jetty)->get();
		return Response::json(Returns::ok($boats));
	}
	public function get_by_operator(Request $request, $operator){
		$boats = Boat::where('operator', $operator)->get();
		return Response::json(Returns::ok($boats));
	}
	public function get(Request $request, $id)
	{
		$boat = Boat::find($id);
		return Response::json(Returns::ok($boat));
	}
}