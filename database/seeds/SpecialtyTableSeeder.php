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
                   'name' => "Médico retén",
               ]);
      
      DB::statement("SELECT SETVAL('specialties_id_seq', (SELECT MAX(id) FROM specialties))");
    }
}
