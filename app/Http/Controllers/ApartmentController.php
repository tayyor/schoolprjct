<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\DataTables\ApartmentDataTable;
use Charts;
use DB;
use App\User;
class ApartmentController extends Controller
{

    public function index(Request $request, $id=null){


            $user_id=$request->user()->id;

            $values = Apartment::select('users.name as landord', DB::raw('count(apartments.id) AS apartments'))
                ->leftJoin('users', 'apartments.owner_id', 'users.id')
                ->groupBy('apartments.owner_id')
                ->get();

            $chart = Charts::create('bar', 'highcharts')
                ->title('Landords Apartments')
                ->elementLabel('Apartments')
                ->labels($values->pluck('landord'))
                ->values($values->pluck('apartments'))
                ->responsive(false);
            $found_user = User::find($user_id);
            if($found_user){
                return view('dashboard.apartment.home', [
                    'page_title'=>'View Apartments '
                    ,'chart'=>$chart,
                    'found_user'=>$found_user,
                    'id'=>$id
                ]);
            }

        return redirect(route('home'))->withErrors([
            'You do not have enough Privilege to perform this operation'
        ]);

    }

    public function table(ApartmentDataTable$dataTable, $id=null){
            if (request()->ajax()) {
                return $dataTable->ajax();
            }
            return $dataTable->render('dashboard.apartment.manage', [
                'page_title'=>'Apartment Management',
                'boat'=> $id?Apartment::find($id):null
            ]);
    }


    public function apartment_save(Request $request, $id=null){
        $validatedData = $request->validate([
            'name'=>'required|max:150',
            'location'=>'string|nullable',
            'address'=>'string',
            'state'=>'string',
            'type'=>'string',
            'owner_id'=>'nullable|exists:users,id'
        ]);

        if($id){
            $boat = Apartment::find($id);
            if($boat){
                $boat->name = $validatedData['name'];
                $boat->location = $validatedData['location'];
                $boat->address = $validatedData['address'];
                $boat->state = $validatedData['state'];
                $boat->type=$validatedData['type'];
                $boat->owner_id=$validatedData['owner_id'];
                $boat->save();
            }
            else{
                return back()->withErrors(['Resource not found.']);
            }
        }
        else {
            Apartment::create($validatedData);
        }

        return redirect(route('apartment.table'))->withInput(['success'=>true]);
    }
}
