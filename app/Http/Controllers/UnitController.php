<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\DataTables\UnitDataTable;
use App\User;
use DB;
use Charts;
class UnitController extends Controller
{
    public function index(Request $request, $id=null){


        $user_id=$request->user()->id;

        $values = Unit::select('apartments.name as apartment', DB::raw('count(units.id) AS units'))
            ->leftJoin('apartments', 'units.apartment_id', 'apartments.id')
            ->groupBy('units.apartment_id')
            ->get();

        $chart = Charts::create('bar', 'highcharts')
            ->title('Units in Apartments')
            ->elementLabel('Units')
            ->labels($values->pluck('apartment'))
            ->values($values->pluck('units'))
            ->responsive(false);
        $found_user = User::find($user_id);
        if($found_user){
            return view('dashboard.unit.home', [
                'page_title'=>'View Units '
                ,'chart'=>$chart,
                'found_user'=>$found_user,
                'id'=>$id
            ]);
        }

        return redirect(route('home'))->withErrors([
            'You do not have enough Privilege to perform this operation'
        ]);

    }

    public function table(UnitDataTable$dataTable, $id=null){
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.unit.manage', [
            'page_title'=>'Apartment Unit Management',
            'jetty'=> $id?Unit::find($id):null
        ]);
    }


    public function unit_save(Request $request, $id=null){
        $validatedData = $request->validate([
            'name'=>'required|max:150',
            'rental_amount'=>'numeric|nullable',
            'security_deposit'=>'numeric|nullable',
            'contact'=>'string',
            'apartment_id'=>'nullable|exists:apartments,id'
        ]);

        if($id){
            $boat = Unit::find($id);
            if($boat){
                $boat->name = $validatedData['name'];
                $boat->rental_amount = $validatedData['rental_amount'];
                $boat->security_deposit = $validatedData['security_deposit'];
                $boat->contact = $validatedData['contact'];
                $boat->apartment_id=$validatedData['apartment_id'];
                $boat->save();
            }
            else{
                return back()->withErrors(['Resource not found.']);
            }
        }
        else {
            Unit::create($validatedData);
        }

        return redirect(route('unit.table'))->withInput(['success'=>true]);
    }

    public function activate_deactivate($id)
    {	$boat=Unit::find($id);
        if($boat->occupied==1)
        {
            $boat->occupied=0;
            $boat->save();
            return back()->withInput(['success'=>true]);
        }
        elseif($boat->occupied==0)
        {
            $boat->occupied=1;
            $boat->save();
            return back()->withInput(['success'=>true]);
        }
        return back()->withErrors(['Resource not found.']);
    }
}
