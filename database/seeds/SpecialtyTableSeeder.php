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
                    'id'=>1,
                   'name' => "Médico general",
               ]);
        DB::table('specialties')->insert([
                    'id'=>2,
	               'name' => "Cardiologia",
	           ]);
    	DB::table('specialties')->insert([
                    'id'=>3,
	               'name' => "Pediatria",
	           ]);
    	DB::table('specialties')->insert([
                    'id'=>4,
	               'name' => "Cirugia",
	           ]);
    }
}
