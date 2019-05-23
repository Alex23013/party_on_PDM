<?php

use Illuminate\Database\Seeder;

class AttentionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attentions')->insert([
    		'attention_code'=>"ATT001",
            'patient_id'=>1,
            'motive'=> "solo es una consulta de prueba",
            'address'=> "la casa del paciente 1",
            'reference'=>"cerca de su casa hay un parque",
            'type'=>1,
        ]);

        DB::table('attentions')->insert([
    		'attention_code'=>"ATT002",
            'patient_id'=>1,
            'motive'=> "emergencia de prueba",
            'address'=> "la universidad paciente 1",
            'reference'=>"en el pasillo del primer piso",
            'type'=>2,
        ]);

         DB::table('attentions')->insert([
            'attention_code'=>"ATT003",
            'patient_id'=>1,
            'motive'=> "otra cita medica de prueba",
            'address'=> "la ucasa del doctor",
            'reference'=>"cerca de la clinica",
            'type'=>1,
        ]);


        DB::table('appointments')->insert([
            'attention_id'=>1,
            'specialty_id'=>1,
            'doctor_id'=>1,
            'date_time'=>'2019-02-02 14:52:16',
        ]);


        DB::table('emergencies')->insert([
            'attention_id'=>2,
            'caller_name'=>"la tia de Juan",
            'caller_dni'=>"87654321",
            'caller_cell'=>"987654321",
        ]);

        DB::table('appointments')->insert([
            'attention_id'=>3,
            'specialty_id'=>2,
            'doctor_id'=>1,
            'date_time'=>'2019-02-02 14:52:16',
        ]);

    }
}
