<?php

namespace App\Http\Controllers\Api;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Returns;
use App\Core\Trips;
use App\Core\Passengers;
use App\Trip;
use Response;
use Validator;

class TripController extends Controller

{    public static function add(Request $request)
	{
       return Response::json(Returns::ok(Trips::create($request)));
    }
    
	public static function get_all()
	{
		return Response::json(Returns::ok(Trips::all()));
	}

	public static function get_by_operator(Request $request, $operator){
		return Response::json(Returns::ok(Trips::get_by_operator($operator)));
	}
	
	public static function start($id,Request $request){
		return Response::json(Returns::ok(Trips::start($id,$request)));
	}
	public static function get(Request $request, $id)
	{
		return Response::json(Returns::ok(Trips::find($id)));
	}
	public static function save_passenger(Request $request,$trip_id)
	{
		return Response::json(Returns::ok(Passengers::create($request,$trip_id,$id=null)));
	}		
}