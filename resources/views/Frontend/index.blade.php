@extends ('Frontend.Layout.app')

@section ('content')
    <div class = "row">
        @if ($value == "index")
            
        @endif

        @if ($value != "index" && $value != "categories" && $value != "top-downloads")
            @foreach ($wallpaper as $wallpapers)
                <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <a href = "{{url('download/' . str_replace(' ', '_', $wallpapers->find($wallpapers->id)->details->image_title) . '-' . $wallpapers->find($wallpapers->id)->details->id)}}">
                        <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
                    </a>
                </div>
            @endforeach
        @endif

        @if ($value == "categories")
            @foreach ($detail as $details)
                @foreach ($wallpaper as $wallpapers)
                    @if ($details->details_id == $wallpapers->details_id)
                        <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <a href = "{{url('download/' . str_replace(' ', '_', $wallpapers->find($wallpapers->id)->details->image_title) . '-' . $wallpapers->find($wallpapers->id)->details->id)}}">
                                <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
                            </a>
                        </div>
                    @endif
                @endforeach
            @endforeach
        @endif

        @if ($value == "top-downloads")
            @foreach ($detail as $details)
                @foreach ($wallpaper as $wallpapers)
                    @if ($details->id == $wallpapers->details_id)
                        <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <a href = "{{url('download/' . str_replace(' ', '_', $wallpapers->find($wallpapers->id)->details->image_title) . '-' . $wallpapers->find($wallpapers->id)->details->id)}}">
                                <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
                            </a>
                        </div>
                    @endif
                @endforeach
            @endforeach
        @endif
    </div>
@endsection