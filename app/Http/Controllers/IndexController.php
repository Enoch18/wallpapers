<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //Functions for the index page
    public function index(){
        return view ("Frontend.index");
    }

    public function tabvalues($value){
        return view ("Frontend.index");
    }

    public function download($id){
        return view ("Frontend.downloadpage");
    }
}
