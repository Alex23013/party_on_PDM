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
                   'color' => "#e60000",
	           ]);
    	DB::table('specialties')->insert([
                    'id'=>3,
	               'name' => "Pediatria",
                   'color' => "#d279a6",
	           ]);
    	DB::table('specialties')->insert([
                    'id'=>4,
	               'name' => "Cirugia",
                   'color' => "#66ffc2",
	           ]);
        DB::statement("SELECT SETVAL('specialties_id_seq', (SELECT MAX(id) FROM specialties))");
    }
}
