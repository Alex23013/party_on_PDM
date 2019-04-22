<?php

use Illuminate\Database\Seeder;

class TechTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('techs')->insert([
	               'name' => "Tecnico 1",
	               'last_name'=>"Test",
	               'dni'=>"02345678",
	               'cellphone'=>"999888777",
	               'active'=>'1',  
	           ]);
        DB::table('techs')->insert([
                   'name' => "Tecnico 2",
                   'last_name'=>"Test",
                   'dni'=>"12345678",
                   'cellphone'=>"999888777",
                   'active'=>'0',  
               ]);
    }
}
