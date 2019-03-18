<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'page_title'=>'Welcome'
    ]);
})->middleware('guest')->name('home.login');

Route::get('/view','ApplicationController@publicunit')->middleware('guest')->name('unit.public');
Route::get('/apply', 'ApplicationController@show')->middleware('guest')->name('application.apply');
Route::post('/add_update/{id?}', 'ApplicationController@application_save')->middleware('guest')->name('application.save');
//Route::get('/table/{id?}','ApplicationController@table')->middleware('guest')->name('application.table');
Auth::routes();

Route::group([
    'prefix'=>'dashboard',
    'middleware'=>['auth']
], function(){
    Route::get('/user/logout', function(){
        Auth::logout();
        return redirect(route('home'));
    })->name('dashboard.logout');
    Route::get('/home', 'HomeController@index')->name('home');
	//Route::get('/home', 'Dashboard\JettysController@index')->name('home');
    Route::group([
        'prefix'=>'profile',
    ], function(){
        Route::get('/view/{id?}', 'Dashboard\ProfileController@index')->name('profile.view');
        Route::get('/edit', 'Dashboard\ProfileController@edit')->name('profile.edit');
        Route::post('/edit/save', 'Dashboard\ProfileController@update')->name('profile.edit.save');
        Route::get('/password/change', 'Dashboard\ProfileController@change_password')->name('profile.password.change');
        Route::post('/password/change/save', 'Dashboard\ProfileController@update_change_password')->name('profile.password.change.save');
    });
	 Route::group([
        'prefix'=>'apartment',
    ], function(){
        Route::get('/home', 'ApartmentController@index')->name('apartment.home');
//        Route::get('/manage/{id?}', 'ApartmentController@manage')->name('apartment.manage');
        Route::post('/add_update/{id?}', 'ApartmentController@apartment_save')->name('apartment.save');
		Route::get('/table/{id?}','ApartmentController@table')->name('apartment.table');
//		 Route::get('/activate_deactivate/{id}', 'ApartmentController@activate_deactivate')->name('apartment.activate_deactivate');
      
    });
	 Route::group([
        'prefix'=>'unit',
    ], function(){
	     Route::get('/home', 'UnitController@index')->name('unit.home');
//         Route::get('/manage/{id?}', 'UnitController@manage')->name('unit.manage');
         Route::post('/add_update/{id?}', 'UnitController@unit_save')->name('unit.save');
        Route::get('/table','UnitController@table')->name('unit.table');
		 Route::get('/activate_deactivate/{id}', 'UnitController@activate_deactivate')->name('unit.activate_deactivate');

     });
	

    Route::group([
        'prefix'=>'users',
    ], function(){
        Route::get('/home', 'Dashboard\AdminController@manage')->name('admin.home');
        Route::get('/add/{user_id?}', 'Dashboard\AdminController@add')->name('admin.add');
        Route::get('/manage/{user_id?}', 'Dashboard\AdminController@manage')->name('admin.manage');
        Route::post('/invite_update/{id?}', 'Dashboard\AdminController@invite_update')->name('admin.invite.update');
        Route::get('/manage/suspend-unsuspend/{id}', 'Dashboard\AdminController@suspend_unsuspend')->name('admin.suspend.unsuspend');
    });


    Route::group([
        'prefix'=>'application',
    ], function(){
        Route::get('/home', 'ApplicationController@index')->name('application.home');


        Route::get('/table/{id?}','ApplicationController@table')->name('application.table');
//		 Route::get('/activate_deactivate/{id}', 'ApartmentController@activate_deactivate')->name('apartment.activate_deactivate');

    });
});

