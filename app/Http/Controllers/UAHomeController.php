<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UAHomeController extends Controller
{    
    public function index()
    {
        return view('UAindex', array('user' => Auth::user()));
    }
}
