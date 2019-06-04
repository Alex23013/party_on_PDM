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
            'id'=>1,
    		'service_name'=> "Delivery",
        ]);
        DB::table('services')->insert([
            'id'=>2,
    		'service_name'=> "Diagnóstico",
        ]);
        DB::table('services')->insert([
            'id'=>3,
    		'service_name'=> "Analisis de sangre",
        ]);
    }
}
