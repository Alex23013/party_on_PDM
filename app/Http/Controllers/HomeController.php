<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','player']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
                    return view('main');        
        
            
    }

    public function player($id){
      return view('hello',['id'=>$id]);
    }

    public function pdf(){
 
      require("phpToPDF.php"); 
     $new_tech = NULL;
     $users = User::all();

     $html = view('techs.tuser_index',compact('new_tech','users'))->renderSections()['content'];
      phptopdf_html($html,'', 'p31.pdf');
     
     echo ("<a href='p31.pdf'>Download Your PDF</a>");
    }
}
