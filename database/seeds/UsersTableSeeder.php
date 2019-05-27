<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('users')->insert([
	               'name' => "Test",
	               'last_name'=>"Master",
	               'dni'=>"02345678",
	               'email' => 'test_master@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>0,
	               'name_role'=>'administrador',      
	           ]);

	    DB::table('users')->insert([
	               'name' => "Test",
	               'last_name'=>"Doctor",
	               'dni'=>"12345678",
	               'email' => 'test_doctor@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>1,
	               'name_role' => 'doctor',	               
	           ]);
	   	DB::table('doctors')->insert([
	    		'user_id'=> 2,
	    		'birth_at'=>"2019-04-16",
	    		'address'=>"su casita",
	    		'specialty'=> "pulmonar",	    		
	    	]);

	    DB::table('users')->insert([
	               'name' => "Test",
	               'last_name'=>"Triaje",
	               'dni'=>"22345678",
	               'email' => 'test_triaje@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>2,
	               'name_role'=>'triaje',	               
	           ]);
	    DB::table('triages')->insert([
	    		'user_id'=> 3,
	    		'is_a_doctor'=>0,
	    	]);

	    DB::table('users')->insert([
	               'name' => "Test",
	               'last_name'=>"Paciente",
	               'dni'=>"32345678",
	               'email' => 'test_paciente@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>3,	 
	               'name_role'=>'paciente',              
	           ]);
	    DB::table('patients')->insert([
	    		'user_id'=> 4,
	    		'patient_code'=>"P-4-1n4d",
	    		'birth_at'=>"2019-04-16",
	    	]);
    }
}
