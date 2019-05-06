<?php

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
    		'name'=> "delivery",
        ]);
        DB::table('services')->insert([
    		'name'=> "diagnostico",
        ]);
        DB::table('services')->insert([
    		'name'=> "analisis de sangre",
        ]);
    }
}
