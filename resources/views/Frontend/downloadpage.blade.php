@extends ('Frontend.Layout.app')

@section ('content')
    <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <a href = "{{url('download/' . str_replace(' ', '_', $wallpapers->find($wallpapers->id)->details->image_title) . '/' . $wallpapers->find($wallpapers->id)->details->id)}}">
            <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
        </a>
    </div>
@endsection