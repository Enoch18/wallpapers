@extends ('Admin.layout.app')

@section ('content')
    <section class = "updatecontainer">
        <h2>Edit your Wallpaper</h2><br />
        <div class = "row">
            <div class = "col-md-6 col-lg-6">
                <div id = "updateimg">
                    <img src = "{{url($wallpaper->url)}}" class = "img img-responsive img-thumbnail">
                </div><br />
                <p><b>Added On: </b>{{$detail->created_at}}</p>
                <p><b>Downloads: </b>{{$detail->downloads ?? '0'}}</p>
                    <form method = "POST" method = "POST" action = "{{url('admin/ssgrouplogin/wallpaperdetailsdelete')}}">
                        @csrf
                        <p><b>Category:</b>
                        @foreach ($category as $categories)
                            @foreach ($catlink as $catlinks)
                                @if ($catlinks->category_id == $categories->id)
                                    <input type = "checkbox" name = "rmcat_id[]" class = "rmcat" value = "{{$catlinks->id}}" style = "display: none;"> {{ucwords($categories->cat_name)}}&nbsp;&nbsp;
                                @endif
                            @endforeach
                        @endforeach
                        <br />
                        <b style = "color: red !important; font-weight: normal !important; cursor: pointer;" id = "rmcattrigger"><u>Remove Category</u></b>
                        <input type = "submit" class = "btn btn-danger" value = "Remove" id = "rmcatbtn" style = "display: none;">
                        </p>
                    </form>
                </p><hr />

                <form method = "POST" method = "POST" action = "{{url('admin/ssgrouplogin/wallpaperdetailsdelete')}}">
                    @csrf
                    <p><b>Subcategory: </b>
                        @foreach ($subcategory as $subcategories)
                            @foreach ($sublink as $sublinks)
                                @if ($sublinks->subcategory_id == $subcategories->id)
                                    <input type = "checkbox" name = "rmsub_id[]" class = "rmsub" value = "{{$sublinks->id}}" style = "display: none;"> {{ucwords($subcategories->sub_name)}}&nbsp;&nbsp;
                                @endif
                            @endforeach
                        @endforeach
                        <br />
                        <b style = "color: red !important; font-weight: normal !important; cursor: pointer;" id = "rmsubtrigger"><u>Remove Subcategory</u></b>
                        <input type = "submit" class = "btn btn-danger" value = "Remove" id = "rmsubbtn" style = "display: none;">
                        </p>
                    </p>
                </form><hr />

                <form method = "POST" method = "POST" action = "{{url('admin/ssgrouplogin/wallpaperdetailsdelete')}}">
                    @csrf
                    <p><b>Tags: </b>
                        @foreach ($tag as $tags)
                            <input type = "hidden" name = "tag_id[]" value = "{{$tags->id}}">
                            <input type = "checkbox" name = "rmtag_id[]" class = "rmtag" value = "{{$tags->id}}" style = "display: none;">
                            <span class = "wallpapertags">{{ucwords($tags->tag_name)}}</span> 
                            <input type = "text" name = "tag_name[]" value = "{{$tags->tag_name}}" class = "renametag" style = "display: none; margin-top: 10px;"> &nbsp;&nbsp;
                        @endforeach
                        <br />
                        <b style = "color: blue !important; font-weight: normal !important; cursor: pointer;" id = "renametrigger"><u>Rename</u></b>&nbsp;&nbsp;&nbsp;
                        <b style = "color: red !important; font-weight: normal !important; cursor: pointer;" id = "rmtagtrigger"><u>Remove Tag</u></b>
                        <input type = "submit" class = "btn btn-primary" value = "Rename" id = "renametagbtn" style = "display: none; margin-top: 10px;">
                        <input type = "submit" class = "btn btn-danger" value = "Remove" id = "rmtagbtn" style = "display: none;">
                        </p>
                    </p>
                </form><hr />
            
                <span id = "admindescription"><p><b>Description: </b></p>{!!$detail->description!!}</span>
                <p><b>Url: </b><a href = "http://www.downloadallwallpapers.com/download/{{str_replace(" ", "_", $detail->image_title)}}-{{$detail->id}}">http://www.downloadallwallpapers.com/download/{{str_replace(" ", "_", $detail->image_title)}}-{{$detail->id}}</a></p>
            </div>

            <div class = "col-md-6 col-lg-6">
                <form class = "form-group" method = "POST" action = "{{url('admin/ssgrouplogin/wallpaper/add')}}/{{$detail->id}}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class = "col-md-12 col-lg-12">
                        <label>Cagetory</label><br />
                        @foreach ($category as $categories)
                            <label class = "checkbox-inline">
                                <input type = "checkbox" name = "catid[]" value = "{{$categories->id}}">{{$categories->cat_name}} &nbsp&nbsp&nbsp&nbsp
                            </label>
                        @endforeach
                        <br /><br />
                    </div>

                    <div class = "col-md-12 col-lg-12">
                        <label>Subcategory</label><br />
                        @foreach ($subcategory as $subcategory)
                            <label class = "checkbox-inline">
                                <input type = "checkbox" name = "subid[]" value = "{{$subcategory->id}}">{{$subcategory->sub_name}} &nbsp&nbsp&nbsp&nbsp
                            </label>
                        @endforeach
                        <br /><br />
                    </div>

                    <div class = "col-md-12 col-lg-12">
                        <label>Image Title/Name</label><br />
                        <input type = "text" name = "image_title" value = "{{$detail->image_title}}" class = "form-control"><br />
                    </div>

                    <div class = "col-md-12 col-lg-12">
                        <label>Author</label><br />
                        <input type = "text" name = "author_name" value = "{{$detail->author}}" class = "form-control"><br />
                    </div>

                    <div class = "col-md-12 col-lg-12">
                        <label>Add More Tags (Seperated by Commas)</label><br />
                        <input type = "hidden" name = "id" value = "{{$detail->id}}">
                        <input type = "text" name = "tags" class = "form-control"><br />
                    </div>

                    <div class = "col-md-12 col-lg-12">
                        <label>Author's Link</label><br />
                        <input type = "text" name = "author_link" value = "{{$detail->author_link}}" class = "form-control"><br />
                    </div>

                    <div class = "col-md-12 col-lg-12">
                        <label>Description</label><br />
                        <textarea name = "description" id = "description">{{$detail->description}}</textarea><br />
                    </div>

                    <div class = "col-md-12 col-lg-12">
                        <input type = "submit" value = "Update" class = "btn btn-primary">
                    </div>
                </form>
            </div>
        </div><br /><br />
    </section>
@endsection