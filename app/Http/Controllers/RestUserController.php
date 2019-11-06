<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Hash;
use App\Http\Requests;
use App\Token;
use App\Party;

class RestUserController extends Controller
{

    public function __construct() { $this->middleware('auth',['except' => ['login','register','resetPass','createParty','joinParty']]); }

    public function login(Request $request){
        $user = User::where('email',$request->email)
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
                        'email' => $user['id'],
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
        $party->latitude = $request->latitude;
        $party->longitude = $request->longitude;
        if($party->save())
        {
            $stat='200';
        }else{
            $stat='401';
        }
        return response()
            ->json(['code' => $party->id,
                    'status' => $stat,
                    'name' => $party->name,
                    'latitude' => $party->latitude,
                    'longitude' => $party->longitude]);
    }

    public function joinParty(Request $request){
        $party = Party::find($request->code);
        if($party != null)
        {
            $stat = '200';
        }
        else
        {
            $stat = '404';
        }
        return response()
            ->json(['status' => $stat,
                    'name' => $party->name,
                    'latitude' => $party->latitude,
                    'longitude' => $party->longitude]);
    }

}
