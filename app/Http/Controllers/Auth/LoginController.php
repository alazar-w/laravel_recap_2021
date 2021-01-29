<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    //logged in users should'nt access login page by any means only gusts or unlogged in users should acceses
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){

        return view('auth.login');
    }

    public function store(Request $request){

        //validation
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //sign the user
        if (!auth()->attempt($request->only('email','password')) && $request->remember){
            return back()->with('status','Invalid login detail');

        }
        //redirect
        return redirect()->route('dashboard');

    }
}
