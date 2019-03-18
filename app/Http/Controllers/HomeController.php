<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Core\Helpers;
use App\Trip;
use App\Trip_passenger;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return redirect(route('profile.view'));
// $date_from = $request->query('start') ?: '01/01/'.date('Y');
//        $date_to = $request->query('end') ?: date('d/m/Y');
//		$values = Trip_passenger::select('jetties.name as unit', DB::raw('count(trip_passengers.passenger_id) AS passengers'))
//		->leftJoin('trips', 'trip_passengers.trip_id', 'trips.id')
//		->leftJoin('jetties', 'trips.from_jetty', 'jetties.id')
//		->where(function($query) use($date_from, $date_to){
//                    $query->whereBetween('trips.depature_time', [
//                        Helpers::dbFriendlyDate(str_replace('/', '-', $date_from)),
//                        Helpers::dbFriendlyDate(str_replace('/', '-', $date_to))
//                    ])->orWhere('trips.depature_time', '0000-00-00');
//					 })
//		->groupBy('jetties.id')
//		->get();
//
//		$stats = Trip::select('operators.name as operator', DB::raw('count(trips.id) AS trips'))
//		->leftJoin('boats', 'trips.boat_id', 'boats.id')
//		->leftJoin('operators','boats.operator','operators.id')
//		->where(function($query) use($date_from, $date_to){
//                    $query->whereBetween('trips.depature_time', [
//                        Helpers::dbFriendlyDate(str_replace('/', '-', $date_from)),
//                        Helpers::dbFriendlyDate(str_replace('/', '-', $date_to))
//                    ])->orWhere('trips.depature_time', '0000-00-00');
//					 })->groupBy('boats.operator')
//		->get();
//
//		$chart = Charts::create('bar', 'highcharts')
//        ->title('Operator Trips')
//        ->elementLabel('Trips')
//        ->labels($stats->pluck('operator'))
//        ->values($stats->pluck('trips'))
//        ->responsive(false);
//		$graph = Charts::create('bar', 'highcharts')
//        ->title('Jetty Passengers')
//        ->elementLabel('Passengers')
//        ->labels($values->pluck('unit'))
//        ->values($values->pluck('passengers'))
//        ->responsive(false);
//        return view('home', [
//            'page_title'=>'Home','chart'=>$chart,'graph'=>$graph,
//            'date_from'=>$date_from,
//            'date_to'=>$date_to
//        ]);
    }

    private function slotValuesInsideLabels($values){
        $ret = [];
        foreach (ProjectAttributes::getStatus() as $status){
            $val = 0;
            foreach($values->toArray() as $db_values){
                if($db_values['status'] == $status){
                    $val = $db_values['total'];
                }
            }
            array_push($ret, $val);
        }
        return $ret;
    }
}
