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
        //Data de prueba: techs 
        // $this->call(TechTableSeeder::class);
        
        
        //Data de prueba: dservices // 
        /*$this->call(ServiceTableSeeder::class);
        $this->call(PatnerTableSeeder::class);
        $this->call(Partner_serviceTableSeeder::class);
        $this->call(DServiceTableSeeder::class);*/
        

        
        //Data de prueba: attentions  // 
        //$this->call(AttentionsTableSeeder::class);
        

        /*
        //Data de prueba: tcalls  //
        $this->call(TcallsTableSeeder::class); 
        */

        
        //Data de prueba: recipes and medicines //  
        /*$this->call(EspecialDoctorTableSeeder::class);        
        $this->call(MoreMedicineTableSeeder::class);   
        $this->call(MoreDoctorkitTableSeeder::class); */
        
    }
}
