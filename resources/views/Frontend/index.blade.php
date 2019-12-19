@extends ('Frontend.Layout.app')

@section ('content')
    <div class = "row">
        @if ($value == "latest")
            @foreach ($wallpaper as $wallpapers)
                <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-3">
                    {{$wallpapers->url}}
                </div>
            @endforeach
        @endif
    </div>
@endsection