@extends ('Frontend.Layout.app')

@section ('content')

    <div class = "row">
        <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4 class = "headinglabel" style = "width: 100% !important;">@if ($cat_name != '') {{ucwords($cat_name)}} @else {{ucwords($detail->image_title)}} @endif<h4>

            <a href = "{{url($wallpaper->url)}}">
                <img src = "{{url($wallpaper->url)}}" class = "img img-responsive img-thumbnail"><br /><br />
            </a>

            <div id="share-buttons">
                <!-- Facebook -->
                <a href="http://www.facebook.com/sharer.php?u=http://www.downloadallwallpapers.com/download/{{str_replace(' ', '_', $detail->image_title)}}-{{$detail->id}}" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                </a>
                
                <!-- Pinterest -->
                <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                    <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
                </a>
                
                <!-- Reddit -->
                <a href="http://reddit.com/submit?url=http://www.downloadallwallpapers.com/download/{{str_replace(' ', '_', $detail->image_title)}}-{{$detail->id}}&amp;title=Simple Share Buttons" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
                </a>
                 
                <!-- Twitter -->
                <a href="https://twitter.com/share?url=http://www.downloadallwallpapers.com/download/{{str_replace(' ', '_', $detail->image_title)}}-{{$detail->id}}&amp;text=Simple%20Share%20Buttons&amp;hashtags=downloadallwallpapers" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                </a>
            
            </div><br />

            <p style = "color: white;" class = "download_p">
                Name: {{$detail->image_title}}<br />
                Downloads: {{$detail->downloads}}<br />
                Category: {{$cat_name}}<br />
                Added On: {{$detail->created_at}}
                <br />
                @if ($detail->author != '')
                    Author's Name: {{$detail->author}}<br />
                @endif

                @if ($detail->author_link != '')
                        Author's Link: <a href = "{{$detail->author_link}}">{{$detail->author_link}}</a>
                @endif
                
                <div class = "desc_p">
                    <p>Description:</p> {!! $detail->description !!}</span><br />
                </div>
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
                {{-- <a href = "{{url($download_5120X2880)}}">5120 x 2880 (5K)</a><br /> --}}
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