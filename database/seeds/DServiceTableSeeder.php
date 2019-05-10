<?php

use Illuminate\Database\Seeder;

class DServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dservices')->insert([
        	'user_id'=> 4,
    		'service_id'=> 1,
    		'partner_id'=>1,
    		'address_from'=>'la clinica asociada',
    		'address_to'=>'la casa del paciente',
    		'delivery'=>'2019-02-08 14:52:16',
    		'execution'=>'2019-02-05 14:52:16',
    		'created_at'=>'2019-02-02 14:52:16',
        ]);

        DB::table('dservices')->insert([
        	'user_id'=> 4,
    		'service_id'=> 1,
    		'partner_id'=>1,
    		'address_from'=>'la clinica asociada',
    		'address_to'=>'la casa del paciente',
    		'created_at'=>'2019-02-02 14:52:16',
        ]);
    }
}
