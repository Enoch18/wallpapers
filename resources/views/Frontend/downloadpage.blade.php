@extends ('Frontend.Layout.app')

@section ('content')

    <div class = "row">
        <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4 class = "headinglabel" style = "width: 100% !important;">@if ($cat_name != '') {{ucwords($cat_name)}} @else {{ucwords($detail->image_title)}} @endif<h4>

            <a href = "{{url($wallpaper->url)}}">
                <img src = "{{url($wallpaper->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
            </a>
            <p style = "color: white;" class = "download_p">
                Name: {{$detail->image_title}}<br />
                Downloads: <br />
                Category: {{$cat_name}}<br />
                Added On: {{$detail->created_at}}<br />
                Description: {!! $detail->description !!}<br />
                <p>Tags: 
                @foreach ($tag as $tags)
                    <a href = "{{url('results')}}?search={{str_replace(' ', '+', $tags->tag_name)}}">{{$tags->tag_name}}</a> &nbsp;&nbsp;&nbsp;
                @endforeach
                </p>
            </p><br />

            <div class = "resolutions">
                <p><i class = "fa fa-download"></i> Download this wallpaper from the following resolutions</p>
                <a href = "{{url($download_1280X720)}}" download = "{{$detail->image_title}}">1280 x 720 (HD)</a><br />
                <a href = "{{url($download_1920X1080)}}" download = "{{$detail->image_title}}">1920 x 1080 (FHD)</a><br />
                <a href = "{{url($download_2560X1440)}}" download = "{{$detail->image_title}}">2560 x 1440 (QHD)</a><br />
                <a href = "{{url($download_3840x2160)}}" download = "{{$detail->image_title}}">3840 x 2160 (4K)</a><br />
                {{-- <a href = "#">5120 x 2880 (5K)</a><br /> --}}
            </div><br /><hr />

            <div class = "ads">
                Advertisement
            </div><br />

            <div class = "related">
                <h4>Related Wallpapers</h4>
                <div class = "row">
                    @foreach ($related as $relateds)
                        @foreach ($relatedwallpaper as $relatedwallpapers)
                            @if ($relateds->details_id == $relatedwallpapers->details_id && $relateds->details_id != $id)
                                <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-4 imgcontainer">
                                    <a href = "{{url('download/' . str_replace(' ', '_', $relatedwallpapers->find($relatedwallpapers->id)->details->image_title) . '-' . $relatedwallpapers->find($relatedwallpapers->id)->details->id)}}">
                                        <img src = "{{url($relatedwallpapers->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
                                    </a>
                                    <div class = "downloadno">
                                        <p><i class = "fa fa-download"></i> {{$relatedwallpapers->find($relatedwallpapers->id)->details->downloads}}</p>
                                    </div>
                                    <p class = "imagename">{{$relatedwallpapers->find($relatedwallpapers->id)->details->image_title}}</p>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection