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
use App\Subscriber;
use App\TagDetail;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //Functions for the index page
    public function index(){
        $value = "index";
        $allcategorytotal = Detail::count();
        $category = Category::all();
        return view ("Frontend.index", compact("category", 'value', 'allcategorytotal'));
    }

    public function tabvalues($value){
        $category = Category::all();

        if ($value == "latest"){
            $allcategorytotal = Detail::count();
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->orderBy('created_at', 'DESC')->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value", "allcategorytotal", "allcategorytotal"));
        }

        if ($value == "top-downloads"){
            $allcategorytotal = Detail::count();
            $detail = Detail::orderBy('downloads', 'DESC')->get();
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value", "detail", "allcategorytotal"));
        }

        if ($value == "random-wallpapers"){
            $allcategorytotal = Detail::count();
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->inRandomOrder()->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value", "allcategorytotal"));
        }

        if ($value != "latest" && $value != "top-downloads" && $value != "random-wallpapers"){
            if ($value != "all-categories"){
                $allcategorytotal = Detail::count();
                $cat_id = Category::where('cat_name', '=' ,$value)->first()->id;
                $detail = CategoryLink::where('category_id', '=', $cat_id)->get();
                $totaldetails = $detail->count();
                $wallpaper = Wallpaper::all();
                $value = "categories";
                return view ("Frontend.index", compact("category", "wallpaper", "value", 'detail', 'value', 'allcategorytotal'));
            }else{
                $allcategorytotal = Detail::count();
                $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->get();
                return view ("Frontend.index", compact("category", "wallpaper", 'detail', 'value', 'allcategorytotal'));
            }
        }
    }

    public function download($id){
        $allcategorytotal = Detail::count();
        $category = Category::all();
        $value = explode("-", $id);
        $image_title = $value[0];
        $id = $value[1];
        $wallpaper = Detail::find($id)->wallpapers->where('width', '=', '1280')->where('height', '=', '720')->first();
        $detail = Detail::find($id);
        $category_id = CategoryLink::where('details_id', '=', $id)->first()->category_id ?? '0';
        $subcategory_id = SubcategoryLink::where('details_id', '=', $id)->first()->subcategory_id ?? '0';
        $cat_name = '';
        $sub_name = '';
        if ($category_id != '0'){
            $cat_name = Category::find($category_id)->cat_name;
        }

        if ($subcategory_id != '0'){
            $sub_name = Subcategory::find($subcategory_id)->sub_name;
        }

        $count = Detail::where('id', '=', $id)->first()->downloads;
        if ($count == ''){
            DB::table('details')->where('id', $id)->update(['downloads' => 1]);
        }else{
            $count = $count + 1;
            DB::table('details')->where('id', $id)->update(['downloads' => $count]);
        }

        return view ("Frontend.downloadpage", compact("category", "wallpaper", "detail", "cat_name", "wallpaper", 'sub_name', 'allcategorytotal'));
    }

    public function subscribe(Request $request){
        $email = $request->email;
        $sub = new Subscriber;
        $subscriber = Subscriber::where('email', '=', $email)->first();
        if ($subscriber == null){
            $sub->email = $email;
            $sub->save();
            return 'not found';
        }else{
            return 'found';
        }
    }
}
