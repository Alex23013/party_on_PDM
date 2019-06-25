<?php

use Illuminate\Database\Seeder;

class MedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->insert([
            'id'=>1,
    		'name'=> "Panadol",
        ]);
        DB::table('medicines')->insert([
            'id'=>2,
    		'name'=> "Naproxeno",
        ]);
        DB::table('medicines')->insert([
            'id'=>3,
    		'name'=> "Curita",
        ]);
        DB::table('medicines')->insert([
            'id'=>4,
    		'name'=> "Repriman",
        ]);
        DB::statement("SELECT SETVAL('medicines_id_seq', (SELECT MAX(id) FROM medicines))");


        DB::table('kits')->insert([
            'id'=>1,
    		'name'=> "Kit del médico general",
        ]);
        DB::statement("SELECT SETVAL('kits_id_seq', (SELECT MAX(id) FROM kits))");


        DB::table('entrykits')->insert([
            'id'=>1,
            'medicine_id'=>1,
            'kit_id'=>1,
            'quantity'=>20,
        ]);
        DB::table('entrykits')->insert([
            'id'=>2,
            'medicine_id'=>2,
            'kit_id'=>1,
            'quantity'=>10,
        ]);
        DB::table('entrykits')->insert([
            'id'=>3,
            'medicine_id'=>3,
            'kit_id'=>1,
            'quantity'=>30,
        ]);
        DB::statement("SELECT SETVAL('entrykits_id_seq', (SELECT MAX(id) FROM entrykits))");
    }
}
