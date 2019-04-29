<?php

use Illuminate\Database\Seeder;

class PatnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 DB::table('partners')->insert([
    	 	'name'=> "farmacia_1",
    	 	'sector'=> 'health',
    	 	'social_reason' => 'SAC',
    	 	'ruc'=>'12345678911',
    	 	'cell_1' => '986756453',
    	 	'cell_2' => '996756453',
    	 	'address' => 'la empresa',
    	 	'hours_of_operation'=>'7:00 am -1:00pm',
    	 	'current_acount'=>'191-0111111-0-33',
    	 	'number_acount'=>'151-0111111-0-33',
    	 	'web_page'=>'farmacia.com.pe',
    	 	'email'=>'farmacia@yopmail.com',
    	 	]);

    	 DB::table('partners')->insert([
    	 	'name'=> "laboratorio_1",
    	 	'sector'=> 'health',
    	 	'social_reason' => 'SRL',
    	 	'ruc'=>'12345671911',
    	 	'cell_1' => '986756453',
    	 	'address' => 'el laboratorio_1',
    	 	]);
    }
}
