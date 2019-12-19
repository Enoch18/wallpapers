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
            return view ("Frontend.index", compact("category", "wallpaper", "value"));
        }

        if ($value == "top-downloads"){
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->orderBy('created_at', 'DESC')->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value"));
        }

        if ($value == "random-wallpapers"){
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->orderBy('created_at', 'DESC')->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value"));
        }
    }

    public function download($id){
        $category = Category::all();
        $value = explode("-", $id);
        $image_title = $value[0];
        $id = $value[1];
        $wallpaper = Detail::find($id)->wallpapers->where('width', '=', '1280')->where('height', '=', '720')->first();
        $detail = Detail::find($id);
        $category_id = CategoryLink::where('details_id', '=', $id)->first()->category_id;
        //$subcategory_id = SubcategoryLink::where('details_id', '=', $id)->first()->subcategory_id;

        $cat_name = Category::find($category_id)->cat_name;
        return view ("Frontend.downloadpage", compact("category", "wallpaper", "detail", "cat_name", "wallpaper"));
    }
}
