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
	    			'id'=>1,
	               'name' => "Test",
	               'last_name'=>"Master",
	               'dni'=>"02345678",
	               'email' => 'test_master@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>0,
	               'name_role'=>'Administrador',      
	           ]);

	    DB::table('users')->insert([
	    			'id'=>2,
	               'name' => "Test",
	               'last_name'=>"Doctor",
	               'dni'=>"12345678",
	               'email' => 'test_doctor@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>1,
	               'name_role' => 'Doctor',	               
	           ]);
	   	DB::table('doctors')->insert([
	   			'id'=>1,
	    		'user_id'=> 2,
	    		'birth_at'=>"2019-04-16",
	    		'address'=>"su casita",
	    		'specialty_id'=> 1,	    		
	    	]);

	    DB::table('users')->insert([
	    			'id'=>3,
	               'name' => "Test",
	               'last_name'=>"Triaje",
	               'dni'=>"22345678",
	               'email' => 'test_triaje@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>2,
	               'name_role'=>'Triaje',	               
	           ]);
	    DB::table('triages')->insert([
	    		'id'=>1,
	    		'user_id'=> 3,
	    		'is_a_doctor'=>0,
	    	]);

	    DB::table('users')->insert([
	    			'id'=>4,
	               'name' => "Test",
	               'last_name'=>"Paciente",
	               'dni'=>"32345678",
	               'email' => 'test_paciente@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>3,	 
	               'name_role'=>'Paciente',              
	           ]);
	    DB::table('patients')->insert([
	    		'id'=>1,
	    		'user_id'=> 4,
	    		'patient_code'=>"P-4-1n4d",
	    		'birth_at'=>"2019-04-16",
	    	]);
	    DB::table('users')->insert([
	    		   'id'=>5,
	               'name' => "Medico Reten",
	               'last_name'=>"doctor_esp",
	               'dni'=>"12345006",
	               'email' => 'test_reten@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>1,
	               'name_role' => 'Doctor',	               
	           ]);
	   	DB::table('doctors')->insert([
	   			'id'=>2,
	    		'user_id'=> 5,
	    		'birth_at'=>"2019-01-13",
	    		'address'=>"su otra casita",
	    		'specialty_id'=> 2,	    		
	    	]);
	    DB::statement("SELECT SETVAL('users_id_seq', (SELECT MAX(id) FROM users))");
	    DB::statement("SELECT SETVAL('patients_id_seq', (SELECT MAX(id) FROM patients))");
	    DB::statement("SELECT SETVAL('triages_id_seq', (SELECT MAX(id) FROM triages))");
	    DB::statement("SELECT SETVAL('doctors_id_seq', (SELECT MAX(id) FROM doctors))");
    }
}
