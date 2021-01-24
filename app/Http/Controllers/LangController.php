<?php

namespace NetworkConfigurator\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LangController extends Controller
{
    public function changeLanguage(Request $request, $language) {
        Session::put('language', $language);
        return redirect()->back();
        
    }
}
