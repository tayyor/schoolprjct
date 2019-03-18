<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name', 'rental_amount', 'security_deposit', 'apartment_id', 'contact', 'occupied'
    ];

    public function apartment(){
        return $this->hasOne('App\Apartment', 'id', 'apartment_id');
    }
    public static function getUnits(){
        $users=Unit::all()->pluck('name','id')->toArray();

        return $users;
    }
}
