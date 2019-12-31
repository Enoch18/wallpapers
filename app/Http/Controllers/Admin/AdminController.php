<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Category;
use App\Subcategory;
use App\Detail;
use App\Wallpaper;
use App\CategoryLink;
use App\SubcategoryLink;
use App\Subscriber;
use App\FrontPage;
use App\Tag;
use App\TagDetail;
use App\User;
use App\visit;
use Illuminate\Support\Facades\DB;

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
        $period = '';
        if (!empty($_GET['period'])){
            $period = $_GET['period'];
        }
        
        if ($period == '' || $period == 'alltimes'){
            $interval = "All Times";
            $value = "dashboard";
            $visits = DB::table("visits")->get()->sum("visit_number");
            $subscribers = count(Subscriber::all());
            $downloads = DB::table("details")->get()->sum("downloads");
            $totalwallpapers = count(Detail::all());
            return view ('Admin.index', compact('value', 'visits', 'subscribers', 'downloads', 'totalwallpapers', 'interval'));
        }

        if ($period == 'oneday'){
            $interval = "Past One Day";
            $time = date("Y-m-d H:i:s");
            $oneday = date('Y-m-d H:i:s', strtotime($time. ' - 1 day'));
            $now = date("Y-m-d H:i:s");

            $value = "dashboard";
            $visits = DB::table("visits")->whereBetween('created_at', [$oneday, $now])->get()->sum("visit_number");
            $subscribers = count(Subscriber::whereBetween('created_at', [$oneday, $now])->get());
            $downloads = DB::table("details")->whereBetween('created_at', [$oneday, $now])->get()->sum("downloads");
            $totalwallpapers = count(Detail::whereBetween('created_at', [$oneday, $now])->get());
            return view ('Admin.index', compact('value', 'visits', 'subscribers', 'downloads', 'totalwallpapers', 'interval'));
        }

        if ($period == 'oneweek'){
            $interval = "Past One Week";
            $time = date("Y-m-d H:i:s");
            $oneweek = date('Y-m-d H:i:s', strtotime($time. ' - 1 week'));
            $now = date("Y-m-d H:i:s");

            $value = "dashboard";
            $visits = DB::table("visits")->whereBetween('created_at', [$oneweek, $now])->get()->sum("visit_number");
            $subscribers = count(Subscriber::whereBetween('created_at', [$oneweek, $now])->get());
            $downloads = DB::table("details")->whereBetween('created_at', [$oneweek, $now])->get()->sum("downloads");
            $totalwallpapers = count(Detail::whereBetween('created_at', [$oneweek, $now])->get());
            return view ('Admin.index', compact('value', 'visits', 'subscribers', 'downloads', 'totalwallpapers', 'interval'));
        }

        if ($period == 'onemonth'){
            $interval = "Past One Month";
            $time = date("Y-m-d H:i:s");
            $onemonth = date('Y-m-d H:i:s', strtotime($time. ' - 1 month'));
            $now = date("Y-m-d H:i:s");

            $value = "dashboard";
            $visits = DB::table("visits")->whereBetween('created_at', [$onemonth, $now])->get()->sum("visit_number");
            $subscribers = count(Subscriber::whereBetween('created_at', [$onemonth, $now])->get());
            $downloads = DB::table("details")->whereBetween('created_at', [$onemonth, $now])->get()->sum("downloads");
            $totalwallpapers = count(Detail::whereBetween('created_at', [$onemonth, $now])->get());
            return view ('Admin.index', compact('value', 'visits', 'subscribers', 'downloads', 'totalwallpapers', 'interval'));
        }
    }

    public function displayvalue($value)
    {
        if ($value == "wallpapers"){
            $search = '';
            if (!empty($_GET['search'])){
                $search = $_GET['search'];
            }

            if ($search == ''){
                $wallpaper = Wallpaper::where('width', '=', '1280')->orderBy('id', 'DESC')->paginate(9);
                $category = Category::all();
                $subcategory = Subcategory::all();
                return view ('Admin.index', compact('value', 'wallpaper', 'category', 'subcategory', 'search'));
            }else{
                return redirect ('admin/ssgrouplogin/search/' . $search);
            }
        }

        if ($value == "categories"){
            $catid = '';
            if (!empty($_GET['catid'])){
                $catid = $_GET['catid'];
            }

            if ($catid == ''){
                $category = Category::orderBy('cat_name', 'ASC')->paginate(20);
                return view ('Admin.index', compact('value', 'category'));
            }

            if ($catid != ''){
                $value = "categorydetails";
                $subcategory = Subcategory::where('category_id', '=', $catid)->get();
                $totalsubcategory = Subcategory::where('category_id', '=', $catid)->count();
                $totalwallpapers = CategoryLink::where('category_id', '=', $catid)->count();
                $lastupdated = CategoryLink::where('category_id', '=', $catid)->max('created_at');
                $cat_name = Category::where('id', '=', $catid)->first()->cat_name;
                return view ('Admin.index', compact('value', 'category', 'subcategory', 'catid', 'cat_name', 'totalsubcategory', 'totalwallpapers', 'lastupdated'));
            }
        }

        if ($value == "subcategories"){
            $category = Category::orderBy('cat_name', 'ASC')->get();
            $subcategory = Subcategory::orderBy('sub_name', 'ASC')->paginate(20);
            return view ('Admin.index', compact('value', 'subcategory', 'category'));
        }

        if ($value == "subscribers"){
            $subscriber = Subscriber::orderBy("created_at", "DESC")->paginate(20);
            return view ('Admin.index', compact('value', 'subscriber'));
        }

        if ($value == "unsubscribers"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "topdownloads"){
            $allcategorytotal = Detail::count();
            $detail = Detail::orderBy('downloads', 'DESC')->get();
            $wallpaper = Wallpaper::where('width', '=', '1280')->where('height', '=', '720')->paginate(12);
            return view ("Admin.index", compact("category", "wallpaper", "value", "detail", "allcategorytotal"));
        }

        if ($value == "frontpages"){
            $categorylist = Category::all();
            $frontcategory = FrontPage::all();
            $fronttags = TagDetail::distinct()->get(['tag_name']);
            $tag = Tag::distinct()->get(['tag_name']);
            return view ('Admin.index', compact('value', 'categorylist', 'tag', 'frontcategory', 'fronttags'));
        }

        if ($value == "newsletters"){
            $wallpaper = Wallpaper::where('width', '=', '1280')->orderBy('created_at', 'DESC')->get();
            return view ('Admin.index', compact('value', 'wallpaper'));
        }

        if ($value == "logindetails"){
            return view ('Admin.index', compact('value'));
        }

        if ($value == "logout"){
            return view ('Admin.index', compact('value'));
        }
    }

    public function searchresult($search){
        $title = $search;
        $category = Category::all();
        $subcategory = Subcategory::all();
        $value = "wallpapers";

        $wallpaper = DB::table('details')
        ->join('wallpapers', 'wallpapers.details_id', 'details.id')
        ->where('wallpapers.width', '=', '1280')->where('wallpapers.height', '=', '720')
        ->where("image_title", "LIKE", "%$search%")
        ->select("details.*", "wallpapers.*")->distinct()->paginate(9);

        $resultscount = DB::table('details')
        ->join('wallpapers', 'wallpapers.details_id', 'details.id')
        ->where('wallpapers.width', '=', '1280')->where('wallpapers.height', '=', '720')
        ->where("image_title", "LIKE", "%$search%")
        ->select("details.*", "wallpapers.*")->distinct()->count();
        
        if ($resultscount > 0){
            return view ("Admin.index", compact("category", "wallpaper", "value", "subcategory", "resultscount", "search", "title"));
        }else{
            $wallpaper = DB::table('details')
            ->join('wallpapers', 'wallpapers.details_id', 'details.id')
            ->join('tags', 'tags.details_id', 'details.id')
            ->where('wallpapers.width', '=', '1280')->where('wallpapers.height', '=', '720')
            ->where("tags.tag_name", "LIKE", "%$search%")
            ->select("details.*", "wallpapers.*", "tags.id")->distinct()->paginate(9);

            $resultscount = DB::table('details')
            ->join('wallpapers', 'wallpapers.details_id', 'details.id')
            ->join('tags', 'tags.details_id', 'details.id')
            ->where('wallpapers.width', '=', '1280')->where('wallpapers.height', '=', '720')
            ->where("tags.tag_name", "LIKE", "%$search%")
            ->select("details.*", "wallpapers.*", "tags.id")->distinct()->count();
            return view ("Admin.index", compact("category", "wallpaper", "value", "subcategory", "resultscount", "search", "title"));
        }
    }

    public function frontpage(Request $request){
        if ($request->category_id){
            foreach($request->category_id as $cat_id){
                $frontpage = new FrontPage;
                $frontpage->category_id = $cat_id;
                $frontpage->save();
            }
            return redirect()->back()->with(['msg' => 'Front Page images Categories added', 'type' => 'success']);
        }

        if ($request->tag_name){
            foreach($request->tag_name as $tagname){
                $checking = TagDetail::where ('tag_name', '=', $tagname)->first();
                if ($checking == null){
                    $frontpage = new TagDetail;
                    $frontpage->tag_name = $tagname;
                    $frontpage->save();
                }
            }
            return redirect()->back()->with(['msg' => 'Front Page iTags have been added', 'type' => 'success']);
        }
    }

    public function updatelogin(Request $request){
        $id = auth()->user()->id;
        $users = User::find($id);
        $password = '';

        if ($request->newpassword != ''){
            $password = Hash::make($request->newpassword);
            $users->password = $password;
            $users->save();
        }

        if ($request->email != ''){
            $users->email = $request->email;
            $users->save();
        }

        if ($request->name != ''){
            $users->name = $request->name;
            $users->save();
        }
        return redirect()->back()->with(['msg' => 'Your login details have been updated', 'type' => 'success']);
    }

    public function deletecategory($id){
        $catdelete = Category::find($id);
        $catdelete->delete();
        
        CategoryLink::where('category_id', $id)->delete();

        $frontpage_cat = FrontPage::where('category_id', '=', $id);
        $frontpage_cat->delete();

        $subcat_id = Subcategory::where('category_id', '=', $id)->first()->id ?? '';
        SubcategoryLink::where('subcategory_id', '=', $subcat_id)->delete();

        $subcat_delete = Subcategory::where('category_id', '=', $id);
        $subcat_delete->delete();
        return redirect()->back()->with(['msg' => 'Your login details have been updated', 'type' => 'success']);
    }

    public function deletesubcategory($id){
        $subcatdelete = Subcategory::find($id);
        $subcatdelete->delete();
        SubcategoryLink::where('subcategory_id', '=', $id)->delete();
        return redirect()->back()->with(['msg' => 'Your login details have been updated', 'type' => 'success']);
    }

    public function tagdelete(Request $request){
        if ($request->tag_delete){
            foreach ($request->tag_delete as $tag){
                TagDetail::where('tag_name', '=', $tag)->delete();
            }
        }

        if ($request->cat_delete){
            foreach ($request->cat_delete as $cat){
                FrontPage::where('category_id', '=', $cat)->delete();
            }
        }
        return redirect()->back()->with(['msg' => 'Deleted Successfully', 'type' => 'success']);
    }

    public function renames(Request $request){
        if ($request->cat_name != ''){
            $catname = $request->cat_name;
            $catid = $request->cat_id;
            
            $rename = Category::find($catid);
            $rename->cat_name = $catname;
            $rename->save();
            return redirect()->back()->with(['msg' => 'Category Successfully Renamed', 'type' => 'success']);
        }

        if ($request->sub_name != ''){
            $subname = $request->sub_name;
            $subid = $request->sub_id;

            $rename = Subcategory::find($subid);
            $rename->sub_name = $subname;
            $rename->save();
            return redirect()->back()->with(['msg' => 'Subcategory Successfully Renamed', 'type' => 'success']);
        }
    }
}
