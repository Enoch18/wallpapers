@extends ('Admin.layout.app')

@section ('content')
    <section class = "updatecontainer">
        <h2>Edit your Wallpaper</h2><br />
        <div class = "row">
            <div class = "col-md-5 col-lg-5">
                <div id = "updateimg">
                    <img src = "{{url($wallpaper->url)}}" class = "img img-responsive img-thumbnail">
                </div><br />
                <p><b>Added On: </b>{{$detail->created_at}}</p>
                <p><b>Downloads: </b>{{$detail->downloads ?? '0'}}</p>
                <p><b>Category: </b>{{$cat_name}}</p>
                <p><b>Subcategory: </b>{{$cat_name}}</p>
                <p><b>Description: </b></p><span>{!!$detail->description!!}</span>
                <p><b>Url: </b>http://www.downloadallwallpapers.com/download/{{str_replace(" ", "_", $detail->image_title)}}-{{$detail->id}}</p>
            </div>

            <div class = "col-md-7 col-lg-7">

            </div>
        </div>
    </section>
@endsection