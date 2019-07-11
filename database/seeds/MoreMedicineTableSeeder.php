<?php

use Illuminate\Database\Seeder;

class MoreMedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('gmedicines')->insert([
            'id'=>1,
    				'group_name'=> "Analgésios Antiinflamatorios",
        ]);
        DB::table('gmedicines')->insert([
            'id'=>2,
    				'group_name'=> "Antipiréticos",
        ]);
        DB::table('gmedicines')->insert([
            'id'=>3,
    				'group_name'=> "Mucolíticos",
        ]);	

        DB::statement("SELECT SETVAL('gmedicines_id_seq', (SELECT MAX(id) FROM gmedicines))");

        DB::table('medicines')->insert([
            'id'=>1,
    				'name'=> "Paracetamol",
    				'medicine_group'=>1,
    				'brand'=>"Panadol",
    				'dosis'=>"500mg",
    				'presentation'=>"Tableta" 		
        ]);
        DB::table('medicines')->insert([
            'id'=>2,
    				'name'=> "Naproxeno", 		
    				'medicine_group'=>1,
    				'brand'=>"Apronax",
    				'dosis'=>"550mg",
    				'presentation'=>"Tableta" 		
        ]);
        DB::table('medicines')->insert([
            'id'=>3,
    				'name'=> "Diclofenaco",
    				'medicine_group'=>1,
    				'brand'=>"Diclo-K",
    				'dosis'=>"50mg",
    				'presentation'=>"Tableta" 		
        ]);
        DB::table('medicines')->insert([
            'id'=>4,
    				'name'=> "Ketorolaco", 	
    				'medicine_group'=>1,
    				'brand'=>"Ketorolac",
    				'dosis'=>"60mg",
    				'presentation'=>"Ampolla" 		
        ]);
        DB::table('medicines')->insert([
            'id'=>5,
    				'name'=> "Metamizol", 				
    				'medicine_group'=>2,
    				'brand'=>"Antalgina",
    				'dosis'=>"500mg",
    				'presentation'=>"Tableta" 		
        ]);
        DB::table('medicines')->insert([
            'id'=>6,
    				'name'=> "Paracetamol", 				
    				'medicine_group'=>2,
    				'brand'=>"Quitadol",
    				'dosis'=>"500mg",
    				'presentation'=>"Tableta" 		
        ]);
        DB::table('medicines')->insert([
            'id'=>7,
    				'name'=> "Ibuprofeno", 			
    				'medicine_group'=>2,
    				'brand'=>"Doloral",
    				'dosis'=>"400mg",
    				'presentation'=>"Tableta" 		
        ]);
        DB::table('medicines')->insert([
            'id'=>8,
    				'name'=> "Ambroxol", 			
    				'medicine_group'=>3,
    				'brand'=>"Muxol",
    				'dosis'=>"15mg/5ml",
    				'presentation'=>"Jarabe" 		
        ]);
        DB::table('medicines')->insert([
            'id'=>9,
    				'name'=> "Ambroxol/Clembuterol", 	
    				'medicine_group'=>3,
    				'brand'=>"Mucosalvan",
    				'dosis'=>"15mg/0.01/5ml",
    				'presentation'=>"Jarabe" 		
        ]);
        DB::statement("SELECT SETVAL('medicines_id_seq', (SELECT MAX(id) FROM medicines))");

        DB::table('kits')->insert([
            'id'=>1,
    				'name'=> "Kit con Data de Prueba DocDoor",
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
            'quantity'=>15,
        ]);
        DB::table('entrykits')->insert([
            'id'=>4,
            'medicine_id'=>4,
            'kit_id'=>1,
            'quantity'=>20,
        ]);
        DB::table('entrykits')->insert([
            'id'=>5,
            'medicine_id'=>5,
            'kit_id'=>1,
            'quantity'=>20,
        ]);
        DB::table('entrykits')->insert([
            'id'=>6,
            'medicine_id'=>6,
            'kit_id'=>1,
            'quantity'=>30,
        ]);
        DB::table('entrykits')->insert([
            'id'=>7,
            'medicine_id'=>7,
            'kit_id'=>1,
            'quantity'=>20,
        ]);
        DB::table('entrykits')->insert([
            'id'=>8,
            'medicine_id'=>8,
            'kit_id'=>1,
            'quantity'=>20,
        ]);
        DB::table('entrykits')->insert([
            'id'=>9,
            'medicine_id'=>9,
            'kit_id'=>1,
            'quantity'=>30,
        ]);
        DB::statement("SELECT SETVAL('entrykits_id_seq', (SELECT MAX(id) FROM entrykits))");
    }
}
