<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'name', 'address', 'location', 'owner_id', 'type', 'state'
    ];

    public function owner(){
        return $this->hasOne('App\User', 'id', 'owner_id');
    }

    public static function getApartments(){
        $values=[];
        $users=Apartment::pluck('name','id')->toArray();

//        foreach ($users as $user)
//        {
//            $value=[$user->id=>$user->id];
//            array_push($values,$value);
//
//
//        }
        return $users;
    }
}
