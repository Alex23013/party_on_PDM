<?php

use Illuminate\Database\Seeder;

class EspecialDoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
	    		   'id'=>5,
	               'name' => "Cardiologo ",
	               'last_name'=>"doctor_esp",
	               'dni'=>"12345000",
	               'email' => 'test_card@yopmail.com',
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
	    		'birth_at'=>"2019-04-13",
	    		'address'=>"su otra casita",
	    		'specialty_id'=> 2,	    		
	    	]);

	   	DB::table('users')->insert([
	    		   'id'=>6,
	               'name' => "Pediatria ",
	               'last_name'=>"doctor_esp",
	               'dni'=>"12345001",
	               'email' => 'test_pedi@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>1,
	               'name_role' => 'Doctor',	               
	           ]);
	   	DB::table('doctors')->insert([
	   			'id'=>3,
	    		'user_id'=> 6,
	    		'birth_at'=>"2019-04-13",
	    		'address'=>"su otra casita",
	    		'specialty_id'=> 3,	    		
	    	]);
	   	DB::table('users')->insert([
	    		   'id'=>7,
	               'name' => "Cirugia",
	               'last_name'=>"doctor_esp",
	               'dni'=>"12345002",
	               'email' => 'test_ciru@yopmail.com',
	               'cellphone'=>"999888777",
	               'password' => bcrypt('123456'),
	               'avatar' => 'default.png',
	               'validated'=>'1',
	               'role'=>1,
	               'name_role' => 'Doctor',	               
	           ]);
	   	DB::table('doctors')->insert([
	   			'id'=>4,
	    		'user_id'=> 7,
	    		'birth_at'=>"2019-04-13",
	    		'address'=>"su otra casita",
	    		'specialty_id'=> 4,	    		
	    	]);
	   	DB::statement("SELECT SETVAL('users_id_seq', (SELECT MAX(id) FROM users))");	
	    DB::statement("SELECT SETVAL('doctors_id_seq', (SELECT MAX(id) FROM doctors))");
    }
}
