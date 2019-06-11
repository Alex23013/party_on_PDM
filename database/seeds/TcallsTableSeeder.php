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
            'id'=>1,
            'patient_id'=>1,
            'patient_cell'=>"987111765",
            'message'=>"Esta es una prueba",
            'type'=>1,
        ]);

        DB::table('tcalls')->insert([
            'id'=>2,
            'patient_cell'=>"987898765",
            'message'=>"Estoy atrapado en el atico",
            'type'=>2,
        ]);

        DB::table('tcalls')->insert([
            'id'=>3,
            'patient_id'=>1,
            'patient_cell'=>"987111765",
            'message'=>"Me gusta hacer pruebas",
            'type'=>1,
        ]);
        DB::statement("SELECT SETVAL('tcalls_id_seq', (SELECT MAX(id) FROM tcalls))");
    }
}
