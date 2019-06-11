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
        // -------- Attentions ----------- //
        DB::table('attentions')->insert([
            'id'=>1,
    		'attention_code'=>"AT-001",
            'patient_id'=>1,
            'motive'=> "solo es una consulta de prueba",
            'address'=> "la casa del paciente 1",
            'reference'=>"cerca de su casa hay un parque",
            'type'=>1,
        ]);

        DB::table('attentions')->insert([
            'id'=>2,
    		'attention_code'=>"AT-002",
            'patient_id'=>1,
            'motive'=> "emergencia de prueba",
            'address'=> "la universidad paciente 1",
            'reference'=>"en el pasillo del primer piso",
            'type'=>2,
        ]);

         DB::table('attentions')->insert([
            'id'=>3,
            'attention_code'=>"AT-003",
            'patient_id'=>1,
            'motive'=> "otra cita medica de prueba",
            'address'=> "la ucasa del doctor",
            'reference'=>"cerca de la clinica",
            'type'=>1,
        ]);

        // -------- emergencies  ----------- //
        // --------     and      ----------- //
        // -------- appointments ----------- //

        DB::table('appointments')->insert([
            'id'=>1,
            'attention_id'=>1,
            'specialty_id'=>1,
            'doctor_id'=>1,
            'date_time'=>'2019-02-02 14:52:16',
        ]);


        DB::table('emergencies')->insert([
            'id'=>1,
            'attention_id'=>2,
            'caller_name'=>"Juan",
            'caller_last_name'=>"Perez",
            'caller_dni'=>"87654321",
            'caller_cell'=>"987654321",
        ]);

        DB::table('appointments')->insert([
            'id'=>2,
            'attention_id'=>3,
            'specialty_id'=>2,
            'doctor_id'=>1,
            'date_time'=>'2019-02-02 14:52:16',
        ]);

        // -------- unregisted  ----------- //
        //--------- emergencies ----------- //

        DB::table('uemergencies')->insert([
            'id'=>1,
            'p_name'=>"Julia",
            'p_last_name'=>"cornejo",
            'p_dni'=>"12356784",
            'p_cell'=>"987678987",
            'motive'=> "emergencia de usuario 1 no registrado",
            'address'=> "la universidad paciente 1",
            'reference'=>"en el pasillo del primer piso"
        ]);

        DB::table('uemergencies')->insert([
            'id'=>2,
            'p_name'=>"Julio",
            'p_last_name'=>"Ramirez",
            'p_dni'=>"12356782",
            'p_cell'=>"987611117",
            'motive'=> "emergencia de usuario 2 no registrado",
            'address'=> "la universidad",
            'reference'=>"en el primer piso"
        ]);
        DB::statement("SELECT SETVAL('attentions_id_seq', (SELECT MAX(id) FROM attentions))");
        DB::statement("SELECT SETVAL('appointments_id_seq', (SELECT MAX(id) FROM appointments))");
        DB::statement("SELECT SETVAL('emergencies_id_seq', (SELECT MAX(id) FROM emergencies))");
        DB::statement("SELECT SETVAL('uemergencies_id_seq', (SELECT MAX(id) FROM uemergencies))");
    }
}
