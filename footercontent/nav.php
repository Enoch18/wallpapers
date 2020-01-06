<?php
    if(isset($_POST['searchsubmit']) && $_POST['search'] != ''){
        $search = $_POST['search'];
        header("Location: ../searchresults.php?search=$search");
    }
?>

<link href = "../assets/css/stylesheet.css" rel = "stylesheet">
<link href = "../assets/css/responsiveness.css" rel = "stylesheet">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class = "row" style = "width: 100%;">
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Add font awesome icons -->
        <!-- <div class = "col-xs-12 col-sm-12 col-ms-12 col-lg-12">
            <div class = "social" style = "display: inline; float: right !important;">
                <a href="https://www.facebook.com/DownloadAllWallpapersDotCom/" target = "_blank" class="facebook"><i class="fa fa-facebook"></i></a> 
                <a href="https://twitter.com/DownloadAllWall" target = "_blank" class="twitter"><i class="fa fa-twitter"></i></a> 
                <a href="https://www.instagram.com/downloadallwallpapersdotcom" target = "_blank" class="instagram"><i class="fa fa-instagram"></i></a>
                <a href = "https://www.pinterest.com/downloadallwallpapers" target = "_blank" class = "pinterest"><i class="fa fa-pinterest"></i></a> 
            </div>
        </div> -->

        <div class = "col-xs-12 col-sm-12 col-ms-12 col-lg-12">
            <img src = "../icons/website banner.jpg" class = "img-responsive" id = "banner">
        </div>
    </div>
</nav>

<div class="navbar navbar-expand-lg navbar-light bg-light" id = "navbar">
    <div id = "inner">
        <!-- <div class = "container"> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" id = "btnclick" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style = "background-color:rgb(218, 218, 250); margin-left: 1px; border-radius: 0px;">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav" style = "margin-top: 10px; margin-bottom: 10px;">
                    <li class="nav-item">
                        <a class="nav-link btn btn-info" href="../index.php">HOME</a><br />
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn btn-info" href="../latest.php">LATEST WALLPAPERS</a><br />
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn btn-info" href="../topdownloads.php">TOP DOWNLOADS</a><br />
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn btn-info" href="../random.php">RANDOM WALLPAPERS</a><br />
                    </li>

                    <li class="nav-item">
                        <form class = "from-group" action = "" method = "POST">
                            <div class = "row">
                                <input type = "search" name = 'search' placeholder = "search" class = "col-lg-7" id = "search"><br /><br />
                                <button type = "submit" name = "searchsubmit" value = "submit" class = "btn btn-primary" id = "searchbtn"><i class="fa fa-search" style = "margin-top: -9px; margin-left: -11px; font-size: 20px;"></i></button><br /><br />
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        <!-- </div> -->
    </div>
</div>