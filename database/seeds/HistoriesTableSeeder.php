<?php

use Illuminate\Database\Seeder;

class HistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('histories')->insert([
            'id'=>1,
            'attention_id'=>1,
            'cardiac_frequency'=>"60 l/m",
            'breathing_frequency'=>"120",
            'temperature'=>"37",
            'arterial_pressure'=>"90/60",
            'personal_antecedents'=>"diabetes congenita",
        ]);
        DB::statement("SELECT SETVAL('histories_id_seq', (SELECT MAX(id) FROM histories))");
    }
}
