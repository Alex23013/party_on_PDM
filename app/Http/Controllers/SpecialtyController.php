<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Specialty;
use App\Doctor;

class SpecialtyController extends Controller
{
    public function index()
 	{
        $all_specialties = Specialty::all();
        $specialties=[];
        foreach ($all_specialties as $key => $value) {
          $num_doctors = count(Doctor::where('specialty_id',$value->id)->get());
          $specialties[] = [
            'name' => $value->name,
            'id' => $value->id,
            'color' => $value->color,
            'num_doctors'=> $num_doctors,
          ];
        }
        $new = NULL;   
        return view('specialties.specialties_index')->with(compact('specialties','new'));
    }

    public function add(){
    	return view('specialties.new_specialty');	
    }

    public function store(Request $request){
    	$rules = [
            'name' => 'required|min:2|max:255',
        ];
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para registrar una especialidad',
            'name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
            'name.max' => 'Campo "Nombre" es demasiado extenso.'
        ];

        $this->validate($request, $rules, $messages);   

        $especialty = New Specialty;
        $especialty->name = $request->name;
        $especialty->color = $request->color;
        $especialty->save();
        
        $all_specialties = Specialty::all();
        $specialties=[];
        foreach ($all_specialties as $key => $value) {
          $num_doctors = count(Doctor::where('specialty_id',$value->id)->get());
          $specialties[] = [
            'name' => $value->name,
            'id' => $value->id,
            'color' => $value->color,
            'num_doctors'=> $num_doctors,
          ];
        }
        $new = $especialty;   
     	return view('specialties.specialties_index')->with(compact('specialties','new'));
    }

    public function update($id){
		$esp = Specialty::find($id);    	
		return view('specialties.specialty_edit')->with(compact('esp'));
    }
    
    public function store_update(Request $request){
    	$esp = Specialty::find($request->id);
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
            if($esp->$key != $data[$key] ){
                $esp->$key=$data[$key];    
            }
           }
        }
        $esp->save();
        return redirect('/specialties/');
    }

     public function delete($id)
    {
        Specialty::destroy($id);
        return redirect('/specialties');
    }
}
