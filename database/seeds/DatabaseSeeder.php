<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SpecialtyTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TechTableSeeder::class);
        
        $this->call(ServiceTableSeeder::class);
        $this->call(PatnerTableSeeder::class);
        $this->call(Partner_serviceTableSeeder::class);
        $this->call(DServiceTableSeeder::class);
        $this->call(AttentionsTableSeeder::class);
        $this->call(TcallsTableSeeder::class);
        
       // $this->call(RoleTableSeeder::class);
    }
}
