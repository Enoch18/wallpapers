@extends ('Frontend.Layout.app')

@section ('content')
    <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <a href = "{{url($wallpaper->url)}}">
            <img src = "{{url($wallpaper->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
        </a>
        <p style = "color: white;" class = "download_p">
            Name: {{$detail->image_title}}<br />
            Downloads: <br />
            Category: {{$cat_name}}<br />
            Added On: {{$detail->created_at}}<br />
            Description: {!! $detail->description !!}<br />
            Tags: 
        </p><br />

        <div class = "resolutions">
            <p>Download this wallpaper from the following resolutions</p>
            <a href = "#">1280 x 720 (HD)</a><br />
            <a href = "#">1920 x 1080 (FHD)</a><br />
            <a href = "#">2560 x 1440 (QHD)</a><br />
            <a href = "#">3840 x 2160 (4K)</a><br />
            <a href = "#">5120 x 2880 (5K)</a><br />
        </div>
    </div>
@endsection