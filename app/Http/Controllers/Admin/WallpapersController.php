<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Detail;
use App\Tag;
use App\Image;
use App\CategoryLink;
Use App\SubcategoryLink;
use File;

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
        // $path = "";
        // if ($request->category_id != ''){
        //     $category_name = Category::find($request->category_id);
        //     $path = public_path() . '/images/' . date("M-Y") . '/' .$category_name->cat_name;
        // }else{
        //     $path = public_path() . '/images/' . date("M-Y") . '/other';
        // }

        // if(!File::makeDirectory($path)){
        //     File::makeDirectory($path, 0777, true, true);
        // }

        $details = new Detail;
        $catlink = new CategoryLink;
        $sublink = new SubcategoryLink;
        $tag = new Tag;

        $details->image_title = $request->image_title;
        $details->author = $request->author_name;
        $details->author_link = $request->author_link;
        $details->description = $request->description;
        $details->liveat = $request->live_at;
        $details->save();

        $details_id = Detail::max('id');
        
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
