<?php

use Illuminate\Database\Seeder;

class espScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                   // 'id'=>11,
                   'name' => "CArdialogia",
                   'last_name'=>"Test_esp",
                   'dni'=>"12345609",
                   'email' => 'test_card@yopmail.com',
                   'cellphone'=>"999888777",
                   'password' => bcrypt('123456'),
                   'avatar' => 'default.png',
                   'validated'=>'1',
                   'role'=>1,
                   'name_role' => 'Doctor',                
               ]);
        $max_id_user = DB::statement("SELECT MAX(id) FROM users");
        DB::table('doctors')->insert([
                //'id'=>3,
                'user_id'=> $max_id_user+1 ,
                'birth_at'=>"2019-04-16",
                'address'=>"su casita",
                'specialty_id'=> 2,             
            ]);
        DB::statement("SELECT SETVAL('users_id_seq', (SELECT MAX(id) FROM users))");
        DB::table('users')->insert([
                    //'id'=>12,
                   'name' => "Pediatra",
                   'last_name'=>"Test_esp",
                   'dni'=>"12345601",
                   'email' => 'test_pedi@yopmail.com',
                   'cellphone'=>"999888777",
                   'password' => bcrypt('123456'),
                   'avatar' => 'default.png',
                   'validated'=>'1',
                   'role'=>1,
                   'name_role' => 'Doctor',                
               ]);
        //$max_id_user = DB::statement("SELECT MAX(id) FROM users");
        DB::table('doctors')->insert([
                //'id'=>4,
                //'user_id'=> 12,
                'user_id'=> $max_id_user +2,
                'birth_at'=>"2019-04-16",
                'address'=>"su casita",
                'specialty_id'=> 3,             
            ]);
        DB::statement("SELECT SETVAL('users_id_seq', (SELECT MAX(id) FROM users))");
        DB::table('users')->insert([
                   // 'id'=>13,
                   'name' => "cirugia",
                   'last_name'=>"Test_esp",
                   'dni'=>"12345602",
                   'email' => 'test_ciru@yopmail.com',
                   'cellphone'=>"999888777",
                   'password' => bcrypt('123456'),
                   'avatar' => 'default.png',
                   'validated'=>'1',
                   'role'=>1,
                   'name_role' => 'Doctor',                
               ]);
        //$max_id_user = DB::statement("SELECT MAX(id) FROM users");
        DB::table('doctors')->insert([
                //'id'=>4,
                //'user_id'=> 13,
                'user_id'=> $max_id_user+3 ,
                'birth_at'=>"2019-09-16",
                'address'=>"su casita",
                'specialty_id'=> 4,             
            ]);

        DB::statement("SELECT SETVAL('users_id_seq', (SELECT MAX(id) FROM users))");
        DB::statement("SELECT SETVAL('doctors_id_seq', (SELECT MAX(id) FROM doctors))");

        $max_id_doctor = DB::statement("SELECT MAX(id) FROM doctors");
        DB::table('espschedules')->insert([  
        		"id"=>1,
        		"doctor_id" =>$max_id_doctor+1,
        		"date"=>'2019-07-03 ',
        		"start_time"=>'14:52:16',
        		"end_time"=>'14:59:16',
        		"color"=>"#009999",
	           ]);
        DB::table('espschedules')->insert([  
                "id"=>2,
                "doctor_id" =>$max_id_doctor+2,
                "date"=>'2019-07-02 ',
                "start_time"=>'14:52:16',
                "end_time"=>'14:59:16',
                "color"=>"#009933",
               ]);
        DB::table('espschedules')->insert([  
                "id"=>3,
                "doctor_id" =>$max_id_doctor,
                "date"=>'2019-07-05 ',
                "start_time"=>'14:52:16',
                "end_time"=>'14:59:16',
                "color"=>"#cc3300",
               ]);
        DB::table('espschedules')->insert([  
                "id"=>4,
                "doctor_id" =>$max_id_doctor,
                "date"=>'2019-07-06 ',
                "start_time"=>'14:52:16',
                "end_time"=>'14:59:16',
                "color"=>"#cc3300",
               ]);
        DB::table('espschedules')->insert([  
                "id"=>5,
                "doctor_id" =>$max_id_doctor+2,
                "date"=>'2019-07-12 ',
                "start_time"=>'14:52:16',
                "end_time"=>'14:59:16',
                "color"=>"#009933",
               ]);
        DB::statement("SELECT SETVAL('espschedules_id_seq', (SELECT MAX(id) FROM espschedules))");
    }
}
