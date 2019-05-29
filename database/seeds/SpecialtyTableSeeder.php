<?php

use Illuminate\Database\Seeder;

class SpecialtyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('specialties')->insert([
                   'name' => "médico general",
               ]);
        DB::table('specialties')->insert([
	               'name' => "cardiologia",
	           ]);
    	DB::table('specialties')->insert([
	               'name' => "pediatria",
	           ]);
    	DB::table('specialties')->insert([
	               'name' => "cirugia",
	           ]);
    }
}
