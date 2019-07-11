<?php

use Illuminate\Database\Seeder;
use App\Medicine;
use App\Entrykit;
class MoreDoctorkitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$entries = Entrykit::where('kit_id',1)->get();
	    $bag=[];
	    foreach ($entries as $key => $value) {
	      $medicine = Medicine::find($value->medicine_id);
	      $medicine_name = $medicine->name.":".$medicine->brand."-".$medicine->dosis;
	      $bag[$key]=(object)[
	      "id"=>$value->id,
	      "quantity"=>$value->quantity,
	      ];
	    }
	    DB::table('doctorkits')->insert([
            'id'=>1,
            'doctor_id'=>1,
            'kit_id'=>1,
            'bag'=>json_encode($bag),
        ]);
       DB::table('doctorkits')->insert([
            'id'=>2,
            'doctor_id'=>2,
            'kit_id'=>1,
            'bag'=>json_encode($bag),
        ]);
       DB::table('doctorkits')->insert([
            'id'=>3,
            'doctor_id'=>3,
            'kit_id'=>1,
            'bag'=>json_encode($bag),
        ]);
       DB::table('doctorkits')->insert([
            'id'=>4,
            'doctor_id'=>4,
            'kit_id'=>1,
            'bag'=>json_encode($bag),
        ]);
       DB::table('doctorkits')->insert([
            'id'=>5,
            'doctor_id'=>5,
            'kit_id'=>1,
            'bag'=>json_encode($bag),
        ]);
        DB::statement("SELECT SETVAL('doctorkits_id_seq', (SELECT MAX(id) FROM doctorkits))");
    }
}
