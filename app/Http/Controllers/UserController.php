<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
	public function index()
    {
        $users = User::all();
        $newUser = NULL;   
        return view('users.user_index')->with(compact('users','newUser'));
    }
 
    public function show($id)
    {
        return User::find($id);
    }

    public function store(Request $request)
    {
        return User::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return 204;
    }
}
