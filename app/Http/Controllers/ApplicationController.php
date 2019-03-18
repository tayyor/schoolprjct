<?php

namespace App\Http\Controllers;

use App\DataTables\PublicUnitDataTable;
use Illuminate\Http\Request;
use App\Application;
use DB;
use App\User;
Use Charts;
use App\DataTables\ApplicationDataTable;
class ApplicationController extends Controller
{
    public function index(Request $request, $id=null){


        $user_id=$request->user()->id;

        $values = Application::select('units.name as unit', DB::raw('count(applications.id) AS applications'))
            ->leftJoin('units', 'applications.unit_id', 'units.id')
            ->groupBy('applications.id')
            ->get();

        $chart = Charts::create('bar', 'highcharts')
            ->title('Applications for Unit')
            ->elementLabel('Applications')
            ->labels($values->pluck('unit'))
            ->values($values->pluck('applications'))
            ->responsive(false);
        $found_user = User::find($user_id);
        if($found_user){
            return view('dashboard.application.home', [
                'page_title'=>'Units '
                ,'chart'=>$chart,
                'found_user'=>$found_user,
                'id'=>$id
            ]);
        }

        return redirect(route('home'))->withErrors([
            'You do not have enough Privilege to perform this operation'
        ]);

    }

    public function table(ApplicationDataTable$dataTable, $id=null){
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.application.manage', [
            'page_title'=>'Application Management',
            'boat'=> $id?Application::find($id):null
        ]);
    }
    public function publicunit(PublicUnitDataTable $dataTable){
        if (request()->ajax()) {
            return $dataTable->ajax();
        }
        return $dataTable->render('dashboard.application.view', [
            'page_title'=>'Application Management'
        ]);
    }
    public function show(){
        return view('dashboard.application.add');
    }
    public function application_save(Request $request){
        $validatedData = $request->validate([
            'name'=>'required|max:150',
            'occupation'=>'string|nullable',
            'age_range'=>'string|nullable',
            'income_range'=>'string',
            'contact'=>'string',
            'family_size'=>'numeric',
            'unit_id'=>'nullable|exists:units,id'
        ]);


            Application::create($validatedData);


        return redirect()->back()->withInput(['success'=>true]);
    }
}
