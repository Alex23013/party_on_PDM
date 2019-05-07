<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\Http\Requests;

class RestPatientsController extends Controller
{
    
	protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'dni' => 'required|size:8|unique:users',
            'cellphone' => 'required|size:9',
            'role' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6'
        ]);
    }

    public function register(Request $request){
    	$data = array();
    	foreach ($request as $key) {
    		$data[]=$request->key;
    	}
    	if(validator($data)){
	        $user = New User;
	        $user->name = $request->name;
	        $user->last_name = $request->last_name;
	        $user->dni =  $request->dni;
	        $user->email = $request->email;
	        $user->password =bcrypt($request->password);
	        $user->cellphone =  $request->cellphone;
	        $user->role =  $request->role;
	        $user->name_role =  "paciente";
	        $user->save();

	        return response()->json($user, 201);
    	}else{
    		return response()->json(null, 204);
    	}
    }

    public function login(Request $request){
    	$user = DB::table('users')
                    ->where('email',$request->email)
                    ->first(); 
    	if($user != null && Hash::check($request->password, $user->password)){
    		return response()->json('usuario valido', 201);
    	}else{
    		return response()->json(null, 204);
    	}
    }

    public function recover(Request $request){
    	$user = DB::table('users')
                    ->where('email',$request->email)
                    ->first(); 
    	if($user != null ){
    		$user = User::find($user->id);   
    		$user->password = $request->password;
    		$user->save();
    		return response()->json('password actualizada', 201);
    	}else{
    		return response()->json(null, 204);
    	}	
    }
}
