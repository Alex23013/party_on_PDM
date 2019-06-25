<?php

use Illuminate\Database\Seeder;

class DoctorkitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctorkits')->insert([
            'id'=>1,
            'doctor_id'=>1,
            'kit_id'=>1,
            'bag'=>"[{\"id\":\"1\",\"name\":\"Panadol\",\"quantity\":\"20\"},{\"id\":\"2\",\"name\":\"Naproxeno\",\"quantity\":\"10\"},{\"id\":\"3\",\"name\":\"Curita\",\"quantity\":\"30\"}]",
        ]);
        DB::statement("SELECT SETVAL('doctorkits_id_seq', (SELECT MAX(id) FROM doctorkits))");
    }
}
