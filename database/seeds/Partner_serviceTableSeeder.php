<?php

use Illuminate\Database\Seeder;

class Partner_serviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('partners_services')->insert([
    		'name'=> "delivery",
    		'partner_id'=>1,
    		'service_cost'=>20,
    		'docdoor_cost'=>5,
        ]);

        DB::table('partners_services')->insert([
    		'name'=> "diagnostico",
    		'partner_id'=>1,
    		'service_cost'=>35,
    		'docdoor_cost'=>10,
        ]);
    }
}
