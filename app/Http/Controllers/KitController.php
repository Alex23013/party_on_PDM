<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Kit;
use App\Doctorkit;
use App\Doctor;
use App\Medicine;
use App\Entrykit;
use App\User;

class KitController extends Controller
{
  public function index()
  {
  	$kits = Kit::all();
  	foreach ($kits as $key => $value) {
  		$num_doctors = count(Doctorkit::where('kit_id',$value->id)->get());
  		$value->count = $num_doctors;
  	}
  	$new = null;
  	return view('kits.kits_index')->with(compact('kits','new'));
  }

  public function detail($id)
  {
  	$kit = Kit::find($id);
  	$doctors = [];
  	$doctorkits = Doctorkit::where('kit_id',$kit->id)->get();
  	foreach ($doctorkits as $key => $value) {
  		$doctor = Doctor::find($value->doctor_id);
  		$doctors[$key]= [
  			'name'=>$doctor->user->name." ".$doctor->user->last_name,
  			'doctor_id'=>$doctor->id,
  		];
  	}
  	$medicines = [];
  	$entrykits = Entrykit::where('kit_id',$kit->id)->get();
  	foreach ($entrykits as $key => $value) {
  		$medicine = Medicine::find($value->medicine_id);
  		$medicines[$key]=[
  			'name'=> $medicine->name,
  			'brand'=> $medicine->brand,
  			'id'=> $medicine->id,
  			'quantity'=>$value->quantity,
  		];
  	}
  	$all_doctors = User::where('role',1)->get();
  	return view('kits.kits_detail')->with(compact('kit','doctors','medicines','all_doctors'));	
  }

   public function create()
  {
  	$medicines = Medicine::all();
    return view('kits.kits_create')->with(compact('kit','medicines'));
  }

  public function store(Request $request){
  	$rules = ['name' => 'required|min:2|max:255'];
    $messages = [
        'name.required' => 'Es necesario ingresar un "Nombre" para registrar un kit',
        'name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
        'name.max' => 'Campo "Nombre" es demasiado extenso.'];
    $this->validate($request, $rules, $messages);  
    $kit = New Kit;
    $kit->name = $request->name;
    $kit->save();

    $quantity =[];
  	foreach ($request->med_quantity as $key => $value) {
  		if($value != ""){$quantity[]=$value;}
  	}

    foreach ($request->medicines as $key => $value) {
    	$entry = New Entrykit;
    	$entry->kit_id = $kit->id;
    	$entry->medicine_id = $value;
    	$entry->quantity = $quantity[$key];
    	$entry ->save();
    }

  	return redirect('/kits');
  }

  public function destroy($id)
  {
    Kit::destroy($id);
    return redirect('/kits');
  }
}
