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
        DB::table('espschedules')->insert([  
        		"id"=>1,
        		"doctor_id" =>4,
        		"date"=>'2019-07-03 ',
        		"start_time"=>'14:52:16',
        		"end_time"=>'14:59:16',
        		"color"=>"#009999",
	           ]);
        DB::table('espschedules')->insert([  
                "id"=>2,
                "doctor_id" =>3,
                "date"=>'2019-07-02 ',
                "start_time"=>'14:52:16',
                "end_time"=>'14:59:16',
                "color"=>"#009933",
               ]);
        DB::table('espschedules')->insert([  
                "id"=>3,
                "doctor_id" =>5,
                "date"=>'2019-07-05 ',
                "start_time"=>'14:52:16',
                "end_time"=>'14:59:16',
                "color"=>"#cc3300",
               ]);
        DB::statement("SELECT SETVAL('espschedules_id_seq', (SELECT MAX(id) FROM espschedules))");
    }
}
