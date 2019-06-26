<<<<<<< HEAD
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
=======
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
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
