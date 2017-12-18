<?php

namespace App\Http\Controllers\Custom;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{
    //
    public function showRegisterForm(){
        return view('custom.register');
    }
    
    public function register(Request $req){
        $this->validation($req);
        User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>bcrypt($req->password),
            'verifyToken' => Str::random(40),
        ]);
        return redirect('/')->with('status','You are registered successfully!');
        //return $req->all();
        
    }
    
    public function validation(Request $req){
        return $this->validate($req, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255', // unique:{TABLE_NAME}
            'password' => 'required|string|confirmed|max:255|min:6',
        ]);
    }
}
