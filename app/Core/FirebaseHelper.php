<?php
/**
 * Created by PhpStorm.
 * User: Musty
 * Date: 1/9/18
 * Time: 9:37 PM
 */

namespace App\Core;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Factory;


class FirebaseHelper
{

    private $firebase;

    public function __construct()
    {

        $serviceAccount = ServiceAccount::fromJsonFile(storage_path('roadzoft-49a702913d28.json'));
        $this->firebase = (new Factory)
            ->withServiceAccountAndApiKey($serviceAccount, env('FIREBASE_WEB_API_KEY', ''))
            ->create();
    }

    public function verifyToken($token){
        $idToken = $this->firebase->getAuth()->verifyIdToken($token);
        return collect([
            'email'=>$idToken->getClaim('email'),
            'name'=>$idToken->getClaim('name'),
            'picture'=>$idToken->getClaim('picture'),
            'user_id'=>$idToken->getClaim('user_id')
        ]);
        //dump($idToken->getClaims());
        //dd($this->idToken->getClaims());
        //d($this->firebase->getAuth()->getUser($this->idToken->getClaim('user_id')));
    }

//    private function getUser($uuid){
//        $user = $this->firebase->getAuth()->getUser($uuid);
//    }
}