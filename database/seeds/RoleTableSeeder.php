<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
	               'name' => "administrador",       
	           ]);
        DB::table('roles')->insert([
	               'name' => "doctor",       
	           ]);
        DB::table('roles')->insert([
	               'name' => "triaje",       
	           ]);
        DB::table('roles')->insert([
	               'name' => "paciente",       
	           ]);
    }
}
