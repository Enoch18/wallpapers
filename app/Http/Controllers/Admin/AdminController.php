<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() 
    {
      $this->middleware('auth');
    }
    
    public function index()
    {
        $value = "index";
        return view ('Admin.index', compact('value'));
    }

    public function displayvalue($value)
    {
        if ($value == "wallpapers"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "categories"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "subcategories"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "subscribers"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "unsubscribers"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "topdownloads"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "frontpages"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "newsletters"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "logindetails"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "logout"){
            return view ('Admin.index', compact('value'));
        }
    }

    public function addwallpapers(){
        return 'added';
    }
}
