<?php
namespace App\Core;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Core\Returns;
use App\Trip;
use App\Trip_staff;
use App\Trip_passenger;
use Response;
use Validator;
/*
 * this class handles function related to trips
 */
class Trips{

    public static function create(Request $request){
        $payload = Helpers::remove_nulls($request->all());
		
        return static::validates_and_exec($payload);
		
    }

 
    private static function validates_and_exec($payload){
		
        $validate_array = [
            'boat_id'=>'required|exists:boats,id',
			'creator'=>'required|exists:users,id',
            'route'=>'required|exists:routes,id',
            'depature_type'=>'required|numeric|in:1,2',
            'depature_time'=>'required'
         ];
        $validate = Validator::make($payload, $validate_array);
        if($validate->fails()){
            return Returns::validationError($validate->errors());
        }
		
        return static::process_trip($payload);
    }
    
    private static function validate_staff($payload){
        foreach ($payload['staff'] as $index=>$value){
            $validate_trip_staff = Validator::make($value, [
            'staff_id'=>'required|exists:users,id']);
            if($validate_staff->fails()){
                return Returns::validationError($validate_staff->errors()->merge(
                    [
                        'staff'=>($index+1)
                    ]));
            } 
            return static::process_trip($payload);
 
        }
    }
    
    
    public static function process_trip($payload){
        //first insert into the trips table
        $tripModel = new Trip();
        $trip_staff_array = [];
		$route=\App\Route::find($payload['route']);
		
		$payload['from_jetty']=$route->from_jetty;
		$payload['to_jetty']=$route->to_jetty;
		
        $trip = Trip::create(collect($payload)->only($tripModel->getFillable())->toArray());
		
        if($trip){
			//dd($payload['staff']);
			$detail=[];
            foreach ($payload['staff'] as $key=>$value){
                $details['trip_id'] = $trip->id->string;
                $details['staff_id']= $value;
			array_push($detail,$details);	
                }
                //try and catch error for a rollback if error error
                try{
				foreach($detail as $pointer=>$array_value)
                    array_push($trip_staff_array, Trip_staff::create($array_value)->toArray());
					
                }
                catch(QueryException $ex){
                    $trip->delete();
                    return Returns::systemError($ex->getMessage());
                }
            }
        
        
        
        return Returns::ok([
            'trip'=> $trip->id->string
        ]);
        
    }
	
	public static function all()
	{
		$trip=Trip::with('trip_staff')->get();
		if($trip){
            return Returns::ok($trip);
        }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
		
	}	

		public static function get($id)
	{
		$trip=Trip::with('trip_staff')->with('trip_passenger')->find($id);
		if($trip){
            return Returns::ok($trip);
        }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
		
	}	
	
	public static function get_by_operator($id)
	{
		Trip::with('trip_staff')->where('operator',$id)->get();
		if($trip){
            return Returns::ok($trip);
        }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
	}
	public static function dashboard_start($id)
	{
		$trip=Trip::find($id);
		$trip->status=1;
		$trip->update();
		if($trip){
            return Returns::ok($trip);
        }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
	}
	public static function start($id,$request)
	{	$trip_passenger_array=[];
		$trip=Trip::find($id);
		$trip->status=1;
		$trip->update();
		   if($trip){
			$detail=[];
		   $payload = Helpers::remove_nulls($request->all());
            foreach ($payload['manifest'] as $key=>$value){
                $details['trip_id'] = $id;
                $details['passenger_id']= $value;
				array_push($detail,$details);	
                }
                //try and catch error for a rollback if error error
                try{
				foreach($detail as $pointer=>$array_value)
                    array_push($trip_passenger_array, Trip_passenger::create($array_value)->toArray());
					return $trip;
					
                }
				catch(QueryException $ex){
                    $trip->delete();
                    return Returns::systemError($ex->getMessage());
                }
		   }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
	}
	
		public static function complete($id,$payload)
	{
		$trip=Trip::find($id);
		$trip->status=3;
		$trip->update();
		if($trip){
            return Returns::ok($trip);
        }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
	}
		public static function cancel($id)
	{
		$trip=Trip::find($id);
		$trip->status=4;
		$trip->update();
		if($trip){
            return Returns::ok($trip);
        }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
	}
		public static function fail($id)
	{
		$trip=Trip::find($id);
		$trip->status=5;
		$trip->update();
		if($trip){
            return Returns::ok($trip);
        }
        return Returns::notfoundError(['err'=>'Trip not found. Check the id']);
	}
	}
    