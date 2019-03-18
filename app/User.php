<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public static $SYSTEM_ADMIN_ROLE = 1;
    public static $OPERATOR_ADMIN = 2;
    public static $ASSITANT_ROLE = 3;
    public static $BOAT_MEN_ROLE = 4;
    public static $LANDLORD = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'home_jetty', 'role', 'picture','operator'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public static function getRoles(){
        return [
            0=>'LANDLORD',
			1=>'SUPER ADMIN',
            2=>'CARE TAKER',
            3=>'TENANT',
            4=>'TENANT DEPENDANT/SPOUSE'
        ];
    }

    public static function getRoleName($role){
        $roles = static::getRoles();
        if(array_key_exists($role, $roles)){
            return $roles[$role];
        }
        return 'INVALID';
    }
	public static function getRoleandUser($operator){
       $users=User::where('operator',$operator)->get();
		$values=[];
	   foreach ($users as $user)
	   {
		   $role=static::getRoleName($user->role);
		   $value=[$user->id=>$user->name.'( '.$role .')'];
		   array_push($values,$value);
		  
		
	   }
	   return $values;
    }
    public static function getUserbyRole($operator){
        $users=User::where('role',$operator)->pluck('name','id')->toArray();

        return $users;
    }

}
