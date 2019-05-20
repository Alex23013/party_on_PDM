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
    	DB::table('partner_services')->insert([
    		'service_id'=> 1,
    		'partner_id'=>1,
    		'service_cost'=>20,
    		'docdoor_cost'=>5,
        ]);

        DB::table('partner_services')->insert([
    		'service_id'=> 2,
    		'partner_id'=>1,
    		'service_cost'=>35,
    		'docdoor_cost'=>10,
        ]);

        DB::table('partner_services')->insert([
            'service_id'=> 3,
            'partner_id'=>2,
            'service_cost'=>52,
            'docdoor_cost'=>10.5,
        ]);
    }
}
