<?php
    if(isset($_POST['searchsubmit']) && $_POST['search'] != ''){
        $search = $_POST['search'];
        header("Location: ../searchresults.php?search=$search");
    }
?>

<title>Download All Wallpapers</title>
<meta name="description" content="Your one-stop destination to download high quality wallpapers of celebrities, food, nature, vehicles, animals, 3D, abstract, and so on in HD, FHD, QHD, 4K and 5K for desktops, mobiles and tablets.">
<meta name="keywords" content="Wallpapers, Images, Wallpaper, Image, Photos, Photo, 5K, FHD, HD, free,download,4k ultra hd,5k uhd,desktop,high quality,cute,stock,best,widescreen,HDTV,1080p full hd,720p hd">
<meta name="robots" content="index, follow" />
<link rel="shortcut icon" href = "icons/ico.ico">
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<script src = "assets/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<link href="assets/css/global.css" rel="stylesheet">
<link href="assets/css/stylesheet.css" rel="stylesheet">
<link href="assets/css/responsiveness.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e185809668efd00128a7878&cms=sop' async='async'></script>
</head>

<?php include ('../customizedstyles.php'); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class = "row" style = "width: 100%;">
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <div class = "col-xs-12 col-sm-12 col-ms-12 col-lg-12" style = "position: relative;">
            <a href = "../" style = "width: 100%;">
                <img src = "../icons/banner.jpg" class = "img-responsive" id = "banner">
            </a>

            <!-- <div class = "social">
                <a href="https://www.facebook.com/" target = "_blank" class="facebook"><i class="fa fa-facebook"></i></a> 
                <a href="https://twitter.com/" target = "_blank" class="twitter"><i class="fa fa-twitter"></i></a> 
                <a href="https://www.instagram.com/" target = "_blank" class="instagram"><i class="fa fa-instagram"></i></a>
                <a href = "https://www.pinterest.com/" target = "_blank" class = "pinterest"><i class="fa fa-pinterest"></i></a>
            </div> -->
        </div>
        <?php 
            $desc = '';
            $bcolor = 'orange';
            $textcolor = 'white';
            try {
                include ('../database/connection.php');
                $sql = "SELECT * FROM customizations WHERE name = 'marquee'";
                $result = $pdo->query($sql);
                while($row = $result->fetch()){
                    $desc = $row['description'];
                    if ($row['backgroundcolor'] != ''){
                        $bcolor = $row['backgroundcolor'];
                    }

                    if ($row['textcolor'] != ''){
                        $textcolor = $row['textcolor'];
                    }
                }
            }catch(PDOException $e){
                echo $e;
            }
        ?>

        <?php if ($desc != ''){ ?>
            <div class = "container">
                <div>
                    <marquee width="100%" direction="left" style = "color: <?php echo $textcolor; ?>;"><p style = "background-color: <?php echo $bcolor; ?>; font-size: 18px; color: <?php echo $textcolor; ?>; padding-top: 1px; padding-bottom: 1px;"><?php echo $desc; ?></p></marquee>
                </div>
            </div>
        <?php } ?>
    </div>
</nav>

<div class = "searchbar" style = "padding-top: 40px;">
    <form class = "from-group" method = "POST">
        <?php 
            $server = $_SERVER['SERVER_NAME'];
            if ($server == 'localhost'){
                $server = "http://" . $server . "/wallpapers";
            }else{
                $server = "http://" . $server;
            }
        ?>
        <div class = "container">
            <div class = "searchcontainer">
                <input type = "search" name = 'search' id = "search" placeholder = "search" class = "form-control">
                <button type = "submit" name = "searchsubmit" value = "submit" class = "btn btn-primary"><i class="fa fa-search"></i></button><br /><br />
                <div id = "list" style = "position: absolute; margin-top: -10px; background-color: white; z-index: 1000; text-align: center;"></div>
                <input type = "hidden" name = "server" id = "server" value = "<?php echo $server; ?>">
            </div>
        </div>
    </form>
</div>

<div class="navbar navbar-expand-lg navbar-light bg-light" id = "navbar">
    <div id = "inner">
        <!-- <div class = "container"> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" id = "btnclick" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style = "background-color:rgb(218, 218, 250); margin-left: 1px; border-radius: 0px;">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav">
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
                        <a class="nav-link btn btn-info" href="../active_tags.php">ACTIVE TAGS</a><br />
                    </li>
                </ul>
            </div>
        <!-- </div> -->
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#btnclick').click(function(){
            $('#navbarSupportedContent').slideToggle();
        })

        $("#search").keyup(function(){
            let search = $("#search").val();
            let server = $("#server").val();
            // list
            if (search != ''){
                $.ajax({
                    url: server + "/predict.php?value=" + search,
                    method: "GET",
                    data: {search: search},
                    success:function(data){
                        $("#list").fadeIn();
                        $("#list").html(data);
                    }
                });
            }else{
                $("#list").fadeOut();
            }

            $(document).on('click', '.select', function(){
                $("#search").val($(this).text());
                $("#list").hide();
            });
        });
    });
</script>