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
    		'service_name'=> "delivery",
        ]);
        DB::table('services')->insert([
    		'service_name'=> "diagnostico",
        ]);
        DB::table('services')->insert([
    		'service_name'=> "analisis de sangre",
        ]);
    }
}
