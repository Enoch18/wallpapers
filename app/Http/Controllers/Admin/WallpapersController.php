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
        $tag = new Tag;
        $wallpaper = new Wallpaper;

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
            //Saving the original resolution
            // $image = $request->file('image');
            // $width = Image::make($image)->width();
            // $height = Image::make($image)->height();
            // $filenameWithExt = $image->getClientOriginalName();
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // $extension = $image->getClientOriginalExtension();
            // $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // $image_resize->save(public_path($stpath. "/" .$fileNameToStore));

            // $wallpaper->details_id = $details_id;
            // $wallpaper->width = $width;
            // $wallpaper->height = $height;
            // $wallpaper->original = 1;
            // $wallpaper->url = $stpath .'/'.$fileNameToStore;
            // $wallpaper->save();

            //Saving the 1280 X 720 resolution
            $image = $request->file('image');
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'1280X720.'.$extension;

            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(1280, 720);
            $image_resize->save(public_path($stpath. "/" .$fileNameToStore));

            $wallpaper->details_id = $details_id;
            $wallpaper->width = "1280";
            $wallpaper->height = "720";
            $wallpaper->original = 0;
            $wallpaper->url = $stpath .'/'.$fileNameToStore;
            $wallpaper->save();

            //Saving the 1920 x 1080 resolution
            $image = $request->file('image');
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'1920x1080.'.$extension;

            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(1920, 1080);
            $image_resize->save(public_path($stpath. "/" .$fileNameToStore));

            $wallpaper->details_id = $details_id;
            $wallpaper->width = "1920";
            $wallpaper->height = "1080";
            $wallpaper->original = 0;
            $wallpaper->url = $stpath .'/'.$fileNameToStore;
            $wallpaper->save();

            //Saving the 2560 x 1440 resolution
            $image = $request->file('image');
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'2560x1440.'.$extension;

            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(2560, 1440);
            $image_resize->save(public_path($stpath. "/" .$fileNameToStore));

            $wallpaper->details_id = $details_id;
            $wallpaper->width = "2560";
            $wallpaper->height = "1440";
            $wallpaper->original = 0;
            $wallpaper->url = $stpath .'/'.$fileNameToStore;
            $wallpaper->save();

            //Saving the 3840 x 2160 resolution
            $image = $request->file('image');
            $filenameWithExt = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'3840x2160.'.$extension;

            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(3840, 2160);
            $image_resize->save(public_path($stpath. "/" .$fileNameToStore));

            $wallpaper->details_id = $details_id;
            $wallpaper->width = "3840";
            $wallpaper->height = "2160";
            $wallpaper->original = 0;
            $wallpaper->url = $stpath .'/'.$fileNameToStore;
            $wallpaper->save();

            //Saving the 5120 x 2880  resolution
            // $image = $request->file('image');
            // $filenameWithExt = $image->getClientOriginalName();
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // $extension = $image->getClientOriginalExtension();
            // $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // $image_resize = Image::make($image->getRealPath());              
            // $image_resize->resize(5120, 2880);
            // $image_resize->save(public_path($stpath. "/" .$fileNameToStore));

            // $wallpaper->details_id = $details_id;
            // $wallpaper->width = "5120";
            // $wallpaper->height = "2880";
            // $wallpaper->original = 0;
            // $wallpaper->url = $stpath .'/'.$fileNameToStore;
            // $wallpaper->save();
        }
        
        $tags = explode (",", $request->tags);

        if (count($tags) > 0){
            for ($i = 0; $i < count($tags); $i++){
                $tag->tag_name = $tags[$i];
                $tag->details_id = $details_id;
                $tag->save();
            }
        }

        if ($request->category_id != ''){
            $catlink->details_id = $details_id;
            $catlink->category_id = $request->category_id;
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
