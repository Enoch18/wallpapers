@extends ('Frontend.Layout.app')

@section ('content')
<h3 style = "color:white; text-align: center;">SITE MAP</h3>
        <h4 style = "color: white;">Categories</h4>
        <div class = "row">
            @foreach ($category as $categories)
                <div class = 'col-xs-2 col-md-2 col-xs-2 col-xs-2'>
                    <a href = "{{url('wallpapers')}}/{{str_replace('/', '+', $categories->cat_name)}}" style = 'font-size: 16px;'>{{$categories->cat_name}}</a><br /><br />
                </div>
            @endforeach
                    
        </div><br /><br />

        <h4 style = "color: white;">Subcategories</h4>
        <div class = "row">
            @foreach ($subcategory as $subcategories)
                <div class = 'col-xs-2 col-md-2 col-xs-2 col-xs-2'>
                    <a href = "{{url('wallpapers')}}/{{str_replace('/', '+', $subcategories->sub_name)}}" style = 'font-size: 16px;'>{{$subcategories->sub_name}}</a><br /><br />
                </div>
            @endforeach
        </div><br /><br />

        <h4 style = "color: white;">Most Downloaded Images</h4>
        <div class = "row">
            @foreach($mostdownloaded as $mostdownloadeds)
                <div class = 'col-xs-2 col-md-2 col-xs-2 col-xs-2'>
                    <a href = "{{url('results')}}?search={{str_replace(' ', '+', $mostdownloadeds->image_title)}}">{{$mostdownloadeds->image_title}}</a>
                </div>
            @endforeach
        </div>
@endsection