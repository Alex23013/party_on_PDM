<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Hash;
use App\Http\Requests;
use App\Token;

use App\Pool;

class RestUserController extends Controller
{

    public function __construct() { $this->middleware('auth',['except' => ['login','register','resetPass','createParty','getPool','play']]); }

    public function play($id){

        return view('player.playsong')->with(compact('id')); 
    }
    public function login(Request $request){
        $user = User::where('email', $request->email)
               ->first();
        if($user != null && Hash::check($request->password, $user->password)){
            $user_obj = User::find($user->id);

            $token = bcrypt(date("ymdHis").$user_obj->email);
            $token = str_replace("/", "-", $token);
            $Token = New Token;
            $Token->token = $token;
            $Token->user_id = $user->id;
            $Token->save();

            return response()
                ->json(['status' => '200',
                        'message' => 'Ok',
                        'token' => $token,
                        'user'=>$user_obj]); 
        }else{
            return response()
                ->json(['status' => '401',
                        'message' => 'credenciales no validas']); 
        }
    }

    public function register(Request $request){
        
        $email_exists = DB::table('users')
                    ->where('email',$request->email)
                    ->first();         
        if ($email_exists){
            return response()
                ->json(['status' => '406',
                        'message' => 'Este email ya ha sido registrado']);  
        }else{
            $user = New User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()
                ->json(['status' => '201',
                        'message' => 'Ok']); 
        }
    }

    public function resetPass(Request $request){
        $user = User::where('email', $request->email)
               ->first();
        if($user != null ){
            $user = User::find($user->id);   
            $user->password =  bcrypt($request->password);
            $user->save();
            return response()
                ->json(['status' => '200',
                        'message' => 'Ok']);
        }else{
            return response()
                ->json(['status' => '406',
                        'message' => 'No existe un usuario registrado para ese correo']);
        }   
    }

    public function createParty(Request $request){
        $party = new Party;
        $party->name = $request->name;
        $party->host_user_id = $request->host_user_id;
        $party->save();
    }

    public function getPool(){
        $pools = Pool::all();
        return response()
                ->json(['status' => '200',
                        'message' => 'Ok',
                        'content'=> $pools]);
    }
}
