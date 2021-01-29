<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //logged in users should'nt access registration page by any means only gusts or unlogged in users should access
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        //dd(di dump -> kill the page and output whatever we give it
        //dd('abc');

        //validation
        //store user
        //sign the user
        //redirect


        //validation
        $this->validate($request,[
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',

        ]);

        //store user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //sign the user
        auth()->attempt($request->only('email','password'));

        //redirect
        return redirect()->route('dashboard');

    }
}
