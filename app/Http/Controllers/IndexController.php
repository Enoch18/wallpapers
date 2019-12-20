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
        $category = Category::all();
        return view ("Frontend.index", compact("category", 'value'));
    }

    public function tabvalues($value){
        $category = Category::all();

        if ($value == "latest"){
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->orderBy('created_at', 'DESC')->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value"));
        }

        if ($value == "top-downloads"){
            $detail = Detail::orderBy('downloads', 'DESC')->get();
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value", "detail"));
        }

        if ($value == "random-wallpapers"){
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->inRandomOrder()->get();
            return view ("Frontend.index", compact("category", "wallpaper", "value"));
        }

        if ($value != "latest" && $value != "top-downloads" && $value != "random-wallpapers"){
            $cat_id = Category::where('cat_name', '=' ,$value)->first()->id;
            $detail = CategoryLink::where('category_id', '=', $cat_id)->get();
            $totaldetails = $detail->count();
            return $totaldetails;
            $wallpaper = Wallpaper::all();
            $value = "categories";
            return view ("Frontend.index", compact("category", "wallpaper", "value", 'detail', 'value'));
        }
    }

    public function download($id){
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

        return view ("Frontend.downloadpage", compact("category", "wallpaper", "detail", "cat_name", "wallpaper", 'sub_name'));
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
