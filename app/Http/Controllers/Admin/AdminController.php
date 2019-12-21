<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Detail;
use App\Wallpaper;
use App\CategoryLink;
use App\SubcategoryLink;
use App\Subscriber;

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
            $wallpaper = Wallpaper::where('width', '=', '1280')->orderBy('id', 'DESC')->get();
            $category = Category::all();
            return view ('Admin.index', compact('value', 'wallpaper', 'category'));
        }

        if ($value == "categories"){
            $category = Category::orderBy('cat_name', 'ASC')->get();
            return view ('Admin.index', compact('value', 'category'));
        }

        if ($value == "subcategories"){
            $category = Category::orderBy('cat_name', 'ASC')->get();
            $subcategory = Subcategory::orderBy('sub_name', 'ASC')->get();
            return view ('Admin.index', compact('value', 'subcategory', 'category'));
        }

        if ($value == "subscribers"){
            $subscriber = Subscriber::orderBy("created_at", "DESC")->get();
            return view ('Admin.index', compact('value', 'subscriber'));
        }

        if ($value == "unsubscribers"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "topdownloads"){
            $allcategorytotal = Detail::count();
            $detail = Detail::orderBy('downloads', 'DESC')->get();
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->get();
            return view ("Admin.index", compact("category", "wallpaper", "value", "detail", "allcategorytotal"));
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
