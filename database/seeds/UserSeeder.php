<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Hafeez Gbenle',
            'email' => 'abdulhaphyz@gmail.com',
            'password' => bcrypt('alwaysalert'),
            'role' => 1,
//			'home_jetty'=>'f58054a6-f6f6-4ba0-9098-2e29e6de4951',
//			'operator'=>'ce3a5cc5-3e36-43bf-bf72-99f4d7ce131c'
        ]);
    }
}
