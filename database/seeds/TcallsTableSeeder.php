<?php

use Illuminate\Database\Seeder;

class TcallsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //--------- tcalls ----------- //

        DB::table('tcalls')->insert([
            'patient_id'=>1,
            'patient_cell'=>"987111765",
            'message'=>"Esta es una prueba",
            'type'=>1,
        ]);

        DB::table('tcalls')->insert([
            'patient_cell'=>"987898765",
            'message'=>"Estoy atrapado en el atico",
            'type'=>2,
        ]);

        DB::table('tcalls')->insert([
            'patient_id'=>1,
            'patient_cell'=>"987111765",
            'message'=>"Me gusta hacer pruebas",
            'type'=>1,
        ]);
    }
}
