@extends ('Frontend.Layout.app')

@section ('content')
<div class = "maincontent">
    <div class = "row">
        @if ($value == "index")
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h4 class = "headinglabel">Popular Categories<h4>
            </div><br /><br />
            
        @endif

        @if ($value != "index" && $value != "categories" && $value != "top-downloads" && $value != "all-categories" && $value != "search")
            @foreach ($wallpaper as $wallpapers)
                <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4 imgcontainer">
                    <a href = "{{url('download/' . str_replace(' ', '_', $wallpapers->find($wallpapers->id)->details->image_title) . '-' . $wallpapers->find($wallpapers->id)->details->id)}}">
                        <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
                    </a>
                    <div class = "downloadno">
                        <p><i class = "fa fa-download"></i> {{$wallpapers->find($wallpapers->id)->details->downloads}}</p>
                    </div>
                    <p class = "imagename">{{ucwords($wallpapers->find($wallpapers->id)->details->image_title)}}</p>
                </div>
            @endforeach
            
            <div class = "pagination">
                {!! $wallpaper->render() !!}
            </div>
        @endif

        @if ($value == "all-categories")
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h4 class = "headinglabel">All Categories<h4>
            </div><br /><br />

            @foreach ($wallpaper as $wallpapers)
                <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4 imgcontainer">
                    <a href = "{{url('download/' . str_replace(' ', '_', $wallpapers->find($wallpapers->id)->details->image_title) . '-' . $wallpapers->find($wallpapers->id)->details->id)}}">
                        <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
                    </a>
                    <div class = "downloadno">
                        <p><i class = "fa fa-download"></i> {{$wallpapers->find($wallpapers->id)->details->downloads}}</p>
                    </div>
                    <p class = "imagename">{{ucwords($wallpapers->find($wallpapers->id)->details->image_title)}}</p>
                </div>
            @endforeach
            
            <div class = "pagination">
                {!! $wallpaper->render() !!}
            </div>
        @endif

        @if ($value == "search")
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h4 class = "headinglabel">Search result for "{{ucwords($search)}}" ({{$resultscount}})<h4>
            </div><br /><br />
            @foreach ($detail as $details)
                @foreach ($wallpaper as $wallpapers)
                    @if ($details->id == $wallpapers->details_id)
                        <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4 imgcontainer">
                            <a href = "{{url('download/' . str_replace(' ', '_', $wallpapers->find($wallpapers->id)->details->image_title) . '-' . $wallpapers->find($wallpapers->id)->details->id)}}">
                                <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
                            </a>
                            <div class = "downloadno">
                                <p><i class = "fa fa-download"></i> {{$wallpapers->find($wallpapers->id)->details->downloads}}</p>
                            </div>
                            <p class = "imagename">{{$wallpapers->find($wallpapers->id)->details->image_title}}</p>
                        </div>
                    @endif
                @endforeach
            @endforeach
        @endif

        @if ($value == "categories")
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h4 class = "headinglabel">{{ucwords($cat_name)}}<h4>
            </div><br /><br />

            @foreach ($detail as $details)
                @foreach ($wallpaper as $wallpapers)
                    @if ($details->details_id == $wallpapers->details_id)
                        <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4 imgcontainer">
                            <a href = "{{url('download/' . str_replace(' ', '_', $wallpapers->find($wallpapers->id)->details->image_title) . '-' . $wallpapers->find($wallpapers->id)->details->id)}}">
                                <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
                            </a>
                            <div class = "downloadno">
                                <p><i class = "fa fa-download"></i> {{$wallpapers->find($wallpapers->id)->details->downloads}}</p>
                            </div>
                            <p class = "imagename">{{$wallpapers->find($wallpapers->id)->details->image_title}}</p>
                        </div>
                    @endif
                @endforeach
            @endforeach

            <div class = "pagination">
                {!! $wallpaper->render() !!}
            </div>
        @endif

        @if ($value == "top-downloads")
            @foreach ($detail as $details)
                @foreach ($wallpaper as $wallpapers)
                    @if ($details->id == $wallpapers->details_id)
                        <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4 imgcontainer">
                            <a href = "{{url('download/' . str_replace(' ', '_', $wallpapers->find($wallpapers->id)->details->image_title) . '-' . $wallpapers->find($wallpapers->id)->details->id)}}">
                                <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
                            </a>
                            <div class = "downloadno">
                                <p><i class = "fa fa-download"></i> {{$wallpapers->find($wallpapers->id)->details->downloads}}</p>
                            </div>
                            <p class = "imagename">{{ucwords($wallpapers->find($wallpapers->id)->details->image_title)}}</p>
                        </div>
                    @endif
                @endforeach
            @endforeach

            <div class = "pagination">
                {!! $wallpaper->render() !!}
            </div>
        @endif
    </div>
</div>
@endsection