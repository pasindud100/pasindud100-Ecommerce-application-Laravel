<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login(){
        return view('auth.login');
    }

    function loginPost( Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt ($credentials)){
            return redirect()->intended(route('home'))
            ->with("success", "You have been login successfully");
       
        }
        return redirect(route('login'))->with("erorr","Invalid email or password");
    }

    function register(){
        return view('auth.register');
    }

    function registerPost(Request $request){
        $request->validate([
            'name' =>'required',
            'email'=> 'required',
            'password'=> 'required|min:6',
        ]);
        $user = new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= Hash::make($request->password);
        if($user ->save()){
            return redirect()->intended(route('login'))
            ->with("success", "You have been registered successfully");
        }
        return redirect(route('register'))->with("error","Something went wrong.");
    }
}
