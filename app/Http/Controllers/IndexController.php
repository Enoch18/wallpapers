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
use App\FrontPage;
use App\visit;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //Functions for the index page
    public function index(){
        $title = "Download All Wallpapers";
        $activetags = TagDetail::all();
        $value = "index";
        $frontpage = FrontPage::all();
        $categorylink = CategoryLink::all();
        $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->orderBy('id', 'DESC')->get();
        $allcategorytotal = Detail::count();
        $detail = Detail::orderby("downloads", "DESC")->get();
        $category = Category::all();
        $catid = TagDetail::all();
        $visitno = visit::all();

        if (count($visitno) < 1){
            $visit = new visit;
            $visit->visit_number = 1;
            $visit->save();
        }else{
            $visitno = visit::where('id', '=', 1)->first()->visit_number;
            $visit = visit::find(1);
            $visitno = $visitno + 1;
            $visit->visit_number = $visitno;
            $visit->save();
        }
        return view ("Frontend.index", compact("category", 'value', 'allcategorytotal', 'activetags', 'title', 'frontpage', 'categorylink', 'wallpaper', 'detail'));
    }

    public function search(Request $request){
        $activetags = TagDetail::all();
        $title = $request->search;
        $category = Category::all();
        $allcategorytotal = Detail::count();
        $search = $request->search;
        $value = "search";
        $detail = DB::table('tags')->join('details', 'details.id', '=', 'tags.details_id')->where("tag_name", "LIKE", "%$search%")->orWhere("image_title", "LIKE", "%$search%")->select("tags.details_id", "details.*")->distinct()->get();
        $resultscount = DB::table('tags')->join('details', 'details.id', '=', 'tags.details_id')->where("tag_name", "LIKE", "%$search%")->orWhere("image_title", "LIKE", "%$search%")->select("tags.details_id", "details.*")->distinct()->get()->count();
        $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->orderBy('created_at', 'DESC')->get();
        return view ("Frontend.index", compact("category", "wallpaper", "value", "allcategorytotal", "detail", "resultscount", "search", "activetags", "title"));
    }

    public function tabvalues($value){
        $category = Category::all();
        $activetags = TagDetail::all();

        if ($value == "latest"){
            $allcategorytotal = Detail::count();
            $title = "Latest Wallpapers";
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->orderBy('created_at', 'DESC')->paginate(3);
            return view ("Frontend.index", compact("category", "wallpaper", "value", "allcategorytotal", "allcategorytotal", "activetags", "title"));
        }

        if ($value == "top-downloads"){
            $activetags = TagDetail::all();
            $title = "Top Downloaded Wallpapers";
            $allcategorytotal = Detail::count();
            $detail = Detail::orderBy('downloads', 'DESC')->get();
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->paginate(3);
            return view ("Frontend.index", compact("category", "wallpaper", "value", "detail", "allcategorytotal", "activetags", "title"));
        }

        if ($value == "random-wallpapers"){
            $activetags = TagDetail::all();
            $title = "Random Wallpapers";
            $allcategorytotal = Detail::count();
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->inRandomOrder()->paginate(3);
            return view ("Frontend.index", compact("category", "wallpaper", "value", "allcategorytotal", "activetags", "title"));
        }

        if ($value != "latest" && $value != "top-downloads" && $value != "random-wallpapers"){
            $activetags = TagDetail::all();
            if ($value != "all-categories"){
                $value = str_replace("+", "/", $value);
                $title = $value;
                $allcategorytotal = Detail::count();
                $cat_id = Category::where('cat_name', '=' ,$value)->first()->id;
                $detail = CategoryLink::where('category_id', '=', $cat_id)->get();
                $totaldetails = $detail->count();
                $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->paginate(3);
                $cat_name = Category::where("id", "=", $cat_id)->first()->cat_name;
                $value = "categories";
                return view ("Frontend.index", compact("category", "wallpaper", "value", 'detail', 'value', 'allcategorytotal', 'cat_name', 'activetags', 'title'));
            }else{
                $value = str_replace("+", "/", $value);
                $title = ucwords(str_replace("-", " ", $value));
                $allcategorytotal = Detail::count();
                $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->paginate(3);
                return view ("Frontend.index", compact("category", "wallpaper", 'detail', 'value', 'allcategorytotal', 'activetags', 'title'));
            }
        }
    }

    public function download($id){
        $activetags = TagDetail::all();
        $allcategorytotal = Detail::count();
        $category = Category::all();
        $value = explode("-", $id);
        $image_title = $value[0];
        $title = $image_title;
        $id = $value[1];
        $wallpaper = Detail::find($id)->wallpapers->where('width', '=', '1280')->where('height', '=', '720')->first();
        $detail = Detail::find($id);
        $tag = Tag::where("details_id", "=", $id)->get();
        $category_id = CategoryLink::where('details_id', '=', $id)->first()->category_id ?? '0';
        $subcategory_id = SubcategoryLink::where('details_id', '=', $id)->first()->subcategory_id ?? '0';
        $related = CategoryLink::where('category_id', '=', $category_id)->get();
        $relatedwallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->limit(4)->get();
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

        $download_1280X720 = Detail::find($id)->wallpapers->where('width', '=', '1280')->where('height', '=', '720')->first()->url;
        $download_1920X1080 = Detail::find($id)->wallpapers->where('width', '=', '1920')->where('height', '=', '1080')->first()->url;
        $download_2560X1440 = Detail::find($id)->wallpapers->where('width', '=', '2560')->where('height', '=', '1440')->first()->url;
        $download_3840x2160 = Detail::find($id)->wallpapers->where('width', '=', '3840')->where('height', '=', '2160')->first()->url;
        // $download_5120X2880 = Detail::find($id)->wallpapers->where('width', '=', '5120')->where('height', '=', '2880')->first()->url;
        return view ("Frontend.downloadpage", compact("category", "wallpaper", "detail", "cat_name", "wallpaper", 'sub_name', 'allcategorytotal', 'tag', 'download_1280X720', 'download_1920X1080', 'download_2560X1440', 'download_3840x2160', 'related', 'relatedwallpaper', 'id', 'activetags', 'title'));
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

    public function disclaimer(){
        $title = "Disclaimer";
        $allcategorytotal = Detail::count();
        $category = Category::all();
        $activetags = TagDetail::all();
        return view("Frontend.disclaimer", compact("category", "allcategorytotal", "activetags", "title"));
    }

    public function privacy(){
        $title = "Privacy";
        $allcategorytotal = Detail::count();
        $category = Category::all();
        $activetags = TagDetail::all();
        return view("Frontend.privacy", compact("category", "allcategorytotal", "activetags", "title"));
    }

    public function terms(){
        $title = "Terms and Conditions";
        $allcategorytotal = Detail::count();
        $category = Category::all();
        $activetags = TagDetail::all();
        return view("Frontend.terms", compact("category", "allcategorytotal", "activetags", "title"));
    }

    public function sitemap(){
        $title = "Sitemap";
        $allcategorytotal = Detail::count();
        $category = Category::all();
        $activetags = TagDetail::all();
        $mostdownloaded = Detail::orderBy("downloads", "DESC")->get();
        $subcategory = Subcategory::all();
        return view("Frontend.sitemap", compact("category", "allcategorytotal", "activetags", "subcategory", "mostdownloaded", "title"));
    }
}
