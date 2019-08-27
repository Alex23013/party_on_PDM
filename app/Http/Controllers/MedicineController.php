<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Medicine;
use App\Gmedicine;

class MedicineController extends Controller
{
   public function index()
 	{
    $all_medicines = Medicine::all();
    $medicines=[];
    foreach ($all_medicines as $key => $value) {
      $group = Gmedicine::find($value->medicine_group);
      $medicines[] = [
        'name' => $value->name,
        'id' => $value->id,
        'brand'=> $value->brand,
        'dosis'=> $value->dosis,
        'presentation'=> $value->presentation,
        'group_name'=> $group->group_name,
      ];
    }
    $new = NULL;   
    return view('medicines.medicine_index')->with(compact('medicines','new'));
   }

    public function add(){
    	$groups = Gmedicine::all();
    	return view('medicines.new_medicine')->with(compact('groups'));	
    }

    public function store(Request $request){
    	$rules = [
          'name' => 'required|min:2|max:255|unique:medicines',
          'brand' => 'required|min:2|max:255',
          'dosis'=> 'required|min:2|max:25',
          'presentation'=> 'required',
          'medicine_group'=> 'required',
      ];
      $messages = [
          'name.required' => 'Es necesario ingresar un nombre para registrar un medicamento',
          'name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
          'name.max' => 'Campo "Nombre" es demasiado extenso.',
          'name.unique' => 'Ya existe un medicamento con ese Nombre.',
          'brand.required' => 'Es necesario ingresar una Marca para registrar un medicamento',
          'brand.min' => 'Ingrese como mínimo 2 caracteres en el campo "Marca".',
          'brand.max' => 'Campo "Marca" es demasiado extenso.',
          'dosis.required' => 'Es necesario ingresar una Dosis para registrar un medicamento',
          'dosis.min' => 'Ingrese como mínimo 2 caracteres en el campo "Dosis".',
          'dosis.max' => 'Campo "Dosis" es demasiado extenso.',
          'presentation.required' => 'Es necesario seleccionar una Presentación para registrar un medicamento',
          'medicine_group.required' => 'Es necesario seleccionar o añadir un Grupo para registrar un medicamento',
      ];

      $this->validate($request, $rules, $messages);   

      $eMedicine = New Medicine;
      $data = $request->all();
      unset($data['_token']);
      
      
      unset($data['new_group']);
      if($request->new_group == 0){
      	$medicine_group = $data['medicine_group'];	
      }else{
      	$newGmedicine = New Gmedicine;
      	$newGmedicine->group_name = $request->medicine_group;
      	$newGmedicine->save();
      	$medicine_group = $newGmedicine->id;
      }
      unset($data['medicine_group']);
      $eMedicine->medicine_group = $medicine_group;
      foreach ($data as $key => $value) {
          $eMedicine->$key = $data[$key] ;
      }   
      $eMedicine->save();
      
      $all_medicines = Medicine::all();
      $medicines=[];
      foreach ($all_medicines as $key => $value) {
        $group = Gmedicine::find($value->medicine_group);
        $medicines[] = [
          'name' => $value->name,
          'id' => $value->id,
          'brand'=> $value->brand,
          'dosis'=> $value->dosis,
          'presentation'=> $value->presentation,
          'group_name'=> $group->group_name,
        ];
      }
      $new = $eMedicine;   
      return view('medicines.medicine_index')->with(compact('medicines','new'));
    }

     public function delete($id)
    {
  		$group = Medicine::find($id)->medicine_group;
  		Medicine::destroy($id);
  		$num = count(Medicine::where('medicine_group',$group)->get());
  		if($num == 0){
  			Gmedicine::destroy($group);
  		}
      return redirect('/medicines');
    }
}
