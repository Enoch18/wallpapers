<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{str_replace("_", " ", $title)}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel = "stylesheet" href = "{{asset('css/app.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <section>
            <div class = "topbanner">
                <img src = "{{asset('banners/banner.jpg')}}"><br />
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link btn btn-primary" href="{{url('/')}}">HOME</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href="{{url('/wallpapers/latest')}}">LATEST WALLPAPERS</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href="{{url('/wallpapers/top-downloads')}}">TOP DOWNLOADS</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href="{{url('/wallpapers/random-wallpapers')}}">RANDOM WALLPAPERS</a>
                            </li>
                        </ul>

                        <form class="form-inline" method = "GET" action = "{{url('results')}}">
                            <input class="form-control mr-sm-2 search" type="search" name = "search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0 searchbtn" type="submit"><i class = "fa fa-search"></i></button>
                        </form>
                    <div>
                </nav>
            </div>

            <div class = "mainbody">
                <div class = "ads">
                    <p>Advertisement</p>
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({
                            google_ad_client: "ca-pub-8918135732106370",
                            enable_page_level_ads: true
                         });
                    </script>
                </div>

                <div class = "row">
                    <div class = "col-lg-2" id = "col1">
                        <ul class = "list-group">
                            <li class = 'list-group-item'><a href = '{{url('/wallpapers/all-categories')}}'>All Categories ({{$allcategorytotal}})</a></li>
                            @foreach ($category as $categories)
                                <li class = 'list-group-item'><a href = '{{url('/wallpapers')}}/{{str_replace('/', '+', $categories->cat_name)}}'>{{$categories->cat_name}} ({{$categories->find($categories->id)->categorylinks->count()}})</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class = "col-lg-8">
                        @yield('content')
                        <hr />
                        
                        <div class = "ads">
                            <p>Advertisement</p>
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({
                                    google_ad_client: "ca-pub-8918135732106370",
                                    enable_page_level_ads: true
                                 });
                            </script>
                        </div>

                        <div class = "populartags">
                            <h4>Popular Tags:</h4>
                            @foreach ($activetags as $activetag)
                            <a href = "{{url('results')}}?search={{str_replace(' ', '+', $activetag->find($activetag->id)->tags->tag_name)}}">{{$activetag->find($activetag->id)->tags->tag_name}}</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            @endforeach
                        </div>
                    </div>

                    <div class = "col-lg-2" id = "col1">
                        <form class = "from-group" id = "form1">
                            @csrf
                            <div id = "sub_success_div" style = "display:none;">
                                <p id = "sub_success"></p><br />
                            </div>

                            <div id = "subscribe" style = "margin-top: -30px !important; display: none;">
                                <input type = "email" name = "email" placeholder = "Email" class = "form-control"><br />
                                <button id = "submit" class = "btn btn-primary" style = "background-color: rgb(73, 133, 204); border: 1px solid rgb(73, 133, 204); width: 100%;">Subscribe</button>
                            </div>
                            <a class = "btn btn-primary form-control" id = "subbtn" style = "background-color: rgb(73, 133, 204); border: 1px solid rgb(73, 133, 204);">Subscribe Here</a><br /><br />
                        </form>
                        
                        <div id = "bannerright">
                            <p>Advertisement</p>
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({
                                    google_ad_client: "ca-pub-8918135732106370",
                                    enable_page_level_ads: true
                                 });
                            </script>
                        </div><br /><br />
                    </div>
                </div><hr />
                <div class = "footer">
                    <p>&copy; 2019 @if (date("Y") != "2019") - {{date("Y")}} @endif, All Rights Reserved.</p>
                    <a href = "{{url('disclaimer')}}">Desclaimer</a> &nbsp;&nbsp;&nbsp; <a href = "{{url('privacy')}}">Privacy Policy</a> &nbsp;&nbsp;&nbsp;<a href = "{{url('terms')}}">Terms of Service</a> &nbsp;&nbsp;&nbsp;
                    <a href = "{{url('sitemap')}}">Site Map</a> &nbsp;&nbsp;&nbsp; <a href = "#">Contact us</a>
                </div>
            </div>
        <section>
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#subbtn").click(function(e){
        e.preventDefault();
        $("#subbtn").hide();
        $("#subscribe").show();
    });

    $("#form1").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: "/subscribe",
            method: "POST",
            data: $("#form1").serialize(),
            success:function(data){
                if (data == "not found"){
                    $("#sub_success_div").show();
                    $("#sub_success").css({
                        color: 'white',
                        fontSize: '18px',
                        fontWeight: '600',
                        backgroundColor: 'green'
                    });
                    $("#sub_success").html("<b>Thank you for subscribing!!!</b>");
                    $("#form1")[0].reset();
                    setTimeout(function(){
                        $("#subbtn").show();
                        $("#subscribe").hide();
                        $("#sub_success_div").hide();
                    }, 5000);
                }

                if (data == "found"){
                    $("#sub_success_div").show();
                    $("#sub_success").css({
                        color: 'white',
                        fontSize: '18px',
                        fontWeight: '600',
                        backgroundColor: 'red'
                    });
                    $("#sub_success").html("<b>That email is already subscribed !!!</b>");
                    $("#form1")[0].reset();
                    setTimeout(function(){
                        $("#subbtn").show();
                        $("#subscribe").hide();
                        $("#sub_success_div").hide();
                    }, 5000);
                }
            }
        });
    });
});
</script>