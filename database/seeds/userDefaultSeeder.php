<?php

use Illuminate\Database\Seeder;

class userDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
			'id'=>1,
           'name' => "user",
           'email' => 'user@yopmail.com',
           'password' => bcrypt('123456'),
       	]);

       	DB::table('users')->insert([
			'id'=>2,
           'name' => "maria",
           'email' => 'maria@yopmail.com',
           'password' => bcrypt('123456'),
       	]);
       	DB::statement("SELECT SETVAL('users_id_seq', (SELECT MAX(id) FROM users))");
    }
}
