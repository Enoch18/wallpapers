<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallpaper;
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

        if ($value == "latest"){
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->orderBy('created_at', 'DESC')->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value", "category"));
        }

        if ($value == "top-downloads"){
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->orderBy('created_at', 'DESC')->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value", "category"));
        }

        if ($value == "random-wallpapers"){
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->orderBy('created_at', 'DESC')->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value", "category"));
        }
    }

    public function download($id){
        return view ("Frontend.downloadpage");
    }
}
