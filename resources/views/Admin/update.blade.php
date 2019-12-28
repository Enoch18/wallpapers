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
                <p><b>Category: </b>{{$cat_name}}</p>
                <p><b>Subcategory: </b>{{$sub_name}}</p>
                <p><b>Description: </b></p><span>{!!$detail->description!!}</span>
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
        </div>
    </section>
@endsection