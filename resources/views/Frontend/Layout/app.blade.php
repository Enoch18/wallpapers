<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel = "stylesheet" href = "{{asset('css/app.css')}}">
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
                                <a class="nav-link btn btn-primary" href="index">HOME</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href="latest">LATEST WALLPAPERS</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href="top-downloads">TOP DOWNLOADS</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn btn-primary" href="random-wallpapers">RANDOM WALLPAPERS</a>
                            </li>
                        </ul>

                        <form class="form-inline">
                            <input class="form-control mr-sm-2 search" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0 searchbtn" type="submit">Search</button>
                        </form>
                    <div>
                </nav>
            </div>

            <div class = "mainbody">
                <div class = "ads">Advertisement</div>

                <div class = "row">
                    <div class = "col-lg-2" id = "col1">
                        <ul class = "list-group">
                            <li class = 'list-group-item'><a href = 'allcategories.php'>All Categories ({{count($category)}})</a></li>
                            @foreach ($category as $categories)
                                <li class = 'list-group-item'><a href = '{{$categories->cat_name}}'>{{$categories->cat_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class = "col-lg-8">
                        @yield('content')
                    </div>

                    <div class = "col-lg-2" id = "col1">
                        <form class = "from-group" action = "" method = "POST">
                            <a href="#" class = "btn btn-primary form-control" id = "subbtn" style = "background-color: rgb(73, 133, 204); border: 1px solid rgb(73, 133, 204);">Subscribe Here</a><br /><br />
                            <div id = "subscribe" style = "margin-top: -30px !important; display: none;">
                                <label style = "font-weight: bold; color: white;">Enter your email</label><br /><br />
                                <input type = "email" name = "email" placeholder = "Email"><br /><br />
                                <input type = "submit" name = "submit" class = "btn btn-primary" value = "Subscribe" style = "background-color: rgb(73, 133, 204); border: 1px solid rgb(73, 133, 204);"><br /><br />
                            </div>
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
                </div>
            </div>
        <section>
    </body>
</html>
