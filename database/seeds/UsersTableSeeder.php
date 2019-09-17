<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		 'name' => 'Rui Martins',
        	 'email' => 'rmartins@hotmail.com',
             'password' => bcrypt('12345678'), // password
             //'identity_card' => Str::random(10),
             'identity_card' => '007387514',
        	 'address' => '',
             'phone' => '',
        	 'role' => 'admin'
    	]);
        User::create([
             'name' => 'Paciente 1',
             'email' => 'paciente@hotmail.com',
             'password' => bcrypt('12345678'), // password
             //'identity_card' => Str::random(10),
             'identity_card' => '107387514',
             'role' => 'patient'
        ]);
        User::create([
             'name' => 'Médico 1',
             'email' => 'medico@hotmail.com',
             'password' => bcrypt('12345678'), // password
             //'identity_card' => Str::random(10),
             'identity_card' => '017387514',
             'role' => 'doctor'
        ]);
    	factory(User::class,50)->states('patient')->create();
    }
}
