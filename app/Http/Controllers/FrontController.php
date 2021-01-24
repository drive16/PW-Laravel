<?php

namespace NetworkConfigurator\Http\Controllers;

class FrontController extends Controller
{
    public function getHome() 
    { 
        return view('index');
    }
}
