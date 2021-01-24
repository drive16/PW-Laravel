<?php

namespace NetworkConfigurator\Http\Controllers;

use Illuminate\Http\Request;
use NetworkConfigurator\DataLayer;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function authentication() 
    {
        return view('auth.auth');
    }
    
    public function login(Request $request)
    {
        session_start();
        $dl = new DataLayer();
        
        if ($dl->validUser($request->input('Username'), $request->input('Password'))) {
            $_SESSION['logged'] = true;
            $_SESSION['loggedName'] = $request->input('Username');
            return Redirect::to(route('router.index'));
        }
        
        return view('auth.authErrorPage');
                
    }
    
    public function logout()
    {
        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }
    
    public function registration(Request $request)
    {
        $dl = new DataLayer();
        $dl->addUser($request->input('Username'), $request->input('Password'), $request->input('Email'));
        
        return Redirect::to(route('user.login'));
    }
}
