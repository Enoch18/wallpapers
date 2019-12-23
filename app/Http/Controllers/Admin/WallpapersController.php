<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Detail;
use App\Tag;
use App\Wallpaper;
use App\CategoryLink;
Use App\SubcategoryLink;
use App\Subcategory;
use App\TagDetail;
use Intervention\Image\Facades\Image;
use File;
use DB;

class WallpapersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $details = new Detail;
        $catlink = new CategoryLink;
        $sublink = new SubcategoryLink;

        $details->image_title = $request->image_title;
        $details->author = $request->author_name;
        $details->author_link = $request->author_link;
        $details->description = $request->description;
        $details->liveat = $request->live_at;
        $details->save();

        $details_id = Detail::max('id');

        $ppath = "";
        $stpath = "";
        if ($request->category_id != ''){
            $category_name = DB::table('categories')->where('id', '=', $request->category_id)->value('cat_name');
            $ppath = str_replace('\\', '/', public_path('storage/images/')) . date("M-Y") . '/' . $category_name;
            $stpath = 'storage/images/' . date("M-Y") . '/' . $category_name;
            if (!File::makeDirectory($ppath, 0777, true, true));
        }else{
            $ppath = str_replace('\\', '/', public_path('storage/images/')) . date("M-Y") . '/others';
            $stpath = 'storage/images/' . date("M-Y") . '/others';
            if (!File::makeDirectory($ppath, 0777, true, true));
        }

        if ($request->hasFile('image')){
            //Saving the 1280 X 720 resolution
            $image = $request->file('image');
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore1 = $filename.'_'.time().'1280X720.'.$extension;
            $fileNameToStore2 = $filename.'_'.time().'1920X1080.'.$extension;
            $fileNameToStore3 = $filename.'_'.time().'2560x1440.'.$extension;
            $fileNameToStore4 = $filename.'_'.time().'3840X2160.'.$extension;
            //$fileNameToStore5 = $filename.'_'.time().'5120X2880.'.$extension;

            $image_resize1 = Image::make($image->getRealPath());              
            $image_resize1->resize(1280, 720);
            $image_resize1->save(public_path($stpath. "/" .$fileNameToStore1));

            $image_resize2 = Image::make($image->getRealPath());              
            $image_resize2->resize(1920, 1080);
            $image_resize2->save(public_path($stpath. "/" .$fileNameToStore2));

            $image_resize3 = Image::make($image->getRealPath());              
            $image_resize3->resize(2560, 1440);
            $image_resize3->save(public_path($stpath. "/" .$fileNameToStore3));

            $image_resize4 = Image::make($image->getRealPath());              
            $image_resize4->resize(3840, 2160);
            $image_resize4->save(public_path($stpath. "/" .$fileNameToStore4));

            // $image_resize5 = Image::make($image->getRealPath());              
            // $image_resize5->resize(5120, 2880);
            // $image_resize5->save(public_path($stpath. "/" .$fileNameToStore5));


            $wallpaper = new Wallpaper;
            $wallpaper->details_id = $details_id;
            $wallpaper->width = "1280";
            $wallpaper->height = "720";
            $wallpaper->original = 0;
            $wallpaper->url = $stpath .'/'.$fileNameToStore1;
            $wallpaper->save();

            $wallpaper = new Wallpaper;
            $wallpaper->details_id = $details_id;
            $wallpaper->width = "1920";
            $wallpaper->height = "1080";
            $wallpaper->original = 0;
            $wallpaper->url = $stpath .'/'.$fileNameToStore2;
            $wallpaper->save();

            $wallpaper = new Wallpaper;
            $wallpaper->details_id = $details_id;
            $wallpaper->width = "2560";
            $wallpaper->height = "1440";
            $wallpaper->original = 0;
            $wallpaper->url = $stpath .'/'.$fileNameToStore3;
            $wallpaper->save();

            $wallpaper = new Wallpaper;
            $wallpaper->details_id = $details_id;
            $wallpaper->width = "3840";
            $wallpaper->height = "2160";
            $wallpaper->original = 0;
            $wallpaper->url = $stpath .'/'.$fileNameToStore4;
            $wallpaper->save();

            // $wallpaper = new Wallpaper;
            // $wallpaper->details_id = $details_id;
            // $wallpaper->width = "5120";
            // $wallpaper->height = "2880";
            // $wallpaper->original = 0;
            // $wallpaper->url = $stpath .'/'.$fileNameToStore5;
            // $wallpaper->save();
        }
        
        $tags = explode (",", $request->tags);

        if (count($tags) > 0){
            for ($i = 0; $i < count($tags); $i++){
                $tag = new Tag;
                $tag->tag_name = $tags[$i];
                $tag->details_id = $details_id;
                $tag->save();
            }
        }

        if ($request->category_id != ''){
            $catlink->details_id = $details_id;
            $catlink->category_id = $request->category_id;
            $catlink->save();
        }else{
            $catlink->details_id = $details_id;
            $catlink->category_id = 0;
            $catlink->save();
        }

        if ($request->subcategory_id != ''){
            $sublink->details_id = $details_id;
            $sublink->subcategory_id = $request->category_id;
            $catlink->save();
        }

        return redirect()->back()->with(['msg' => 'Wallpaper successfull added', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::orderBy("created_at", "DESC")->get();
        $subcategory = Subcategory::orderBy("created_at", "DESC")->get();
        $detail = Detail::find($id);
        $wallpaper = Wallpaper::where('details_id', '=', $id)->where('width', '=', '1280')->where('height', '=', '720')->first();
        $tag = Tag::where("details_id", "=", $id)->first();
        $category_id = CategoryLink::where('details_id', '=', $id)->first()->category_id ?? '';
        $cat_name = Category::where('id', '=', $category_id)->first()->cat_name ?? 'Uncategorized';

        return view ("Admin.update", compact("detail", "wallpaper", "tag", "cat_name", "category", "subcategory"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $details = Detail::find($id);
        $details->image_title = $request->image_title;
        $details->author = $request->author_name;
        $details->author_link = $request->author_link;
        $details->description = $request->description;
        $details->save();
        return redirect()->back()->with(['msg' => 'Wallpaper successfully updated', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail_id = Wallpaper::where("id", "=", $id)->first()->details_id;
        $wallpaper = Wallpaper::where("details_id", "=", $detail_id)->get();
        foreach ($wallpaper as $wallpapers){
            unlink ($wallpapers->url);
        }

        $tag = Tag::where("details_id", "=", $detail_id)->get();
        foreach ($tag as $tags){
            TagDetail::where("tag_id", "=", $tags->id)->delete();
        }

        Wallpaper::where("details_id", "=", $detail_id)->delete();
        CategoryLink::where("details_id", "=", $detail_id)->delete();
        SubcategoryLink::where("details_id", "=", $detail_id)->delete();
        Tag::where("details_id", "=", $detail_id)->delete();
        Detail::find($detail_id)->delete();
        return redirect()->back()->with(['msg' => 'Wallpaper successfull added', 'type' => 'success']);
    }
}
