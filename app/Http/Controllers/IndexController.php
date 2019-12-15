<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Category;
use App\Subcategory;
use App\CategoryLink;
use App\Detail;
use App\SubcategoryLink;
use App\Tag;
use App\TagDetail;

class IndexController extends Controller
{
    //Functions for the index page
    public function index(){
        $category = Category::all();
        return view ("Frontend.index", compact("category"));
    }

    public function tabvalues($value){
        $category = Category::all();
        return view ("Frontend.index", compact("category"));
    }

    public function download($id){
        return view ("Frontend.downloadpage");
    }
}
