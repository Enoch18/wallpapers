<?php 
error_reporting(0);
include ('database/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8918135732106370",
            enable_page_level_ads: true
        });
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Your one-stop destination to download high quality wallpapers of celebrities, food, nature, vehicles, animals, 3D, abstract, and so on in HD, FHD, QHD, 4K and 5K for desktops, mobiles and tablets.">
    <meta name="keywords" content="Wallpapers, Images, Wallpaper, Image, Photos, Photo, 5K, FHD, HD, free,download,4k ultra hd,5k uhd,desktop,high quality,cute,stock,best,widescreen,HDTV,1080p full hd,720p hd">
    <meta name="robots" content="index, follow" />
    <title>Download All Wallpapers</title>
    <link rel="shortcut icon" href = "icons/ico.ico">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src = "assets/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="assets/css/global.css" rel="stylesheet">
    <link href="assets/css/stylesheet.css" rel="stylesheet">
    <link href="assets/css/responsiveness.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<script>
$(document).ready(function(){
    $('#subscribe').hide();
    $('#subbtn').click(function($e){
        $e.preventDefault();
        $('#subbtn').hide();
        $('#subscribe').show();
    })
})
</script>

<body>
    <div id = "color">
        <?php include ('navbar.php'); ?>

        <div id = "ads" style = "margin-left: auto !important; margin-right: auto !important;">
            <p>Advertisement</p>
			<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- New horiznontal -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-8918135732106370"
                data-ad-slot="4329202681"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div><br />

    <div class = "row" id = row>
            <?php include ('sidebar1.php'); ?>
            <div class = "col-lg-8" id = "col2">
                <div class = "row" style = "color: white !important;">
                    <div class = "col-lg-12" style = "margin-left: -5px;">
                        <h4 id = "heading">ACTIVE TAGS</h4>
                    </div>

                    <?php 
                        $tags = array();
                        $count = '';

                        try{
                            $sql = "SELECT DISTINCT tagname FROM tagdetails AS t, tags AS ta WHERE t.id = ta.tag_id";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                $tags[] = $row['tagname'];
                            }
                            $count = count($tags);
                        }catch(PDOException $e){
                            echo "An error occured" . $e;
                        }

                        if($count == ''){
                            echo "
                            <div class = 'col-xs-12 col-md-12 col-sm-12 col-lg-12' style = 'text-align: center;'>
                                <h6 style = 'font-weight: bold;'>No active tags yet</h6>
                            </div>";
                        }

                        for($i=0; $i<$count; $i++){
                            echo"
                                <a href = 'searchresults.php?search=$tags[$i]'  
                                    class = 'populartags'>
                                    $tags[$i]
                                </a><br /><br />
                            ";
                        }
                    ?>
                </div><br /><br />

                    
                <div id = "ad">
                    <p>Advertisement</p>
					<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- New horiznontal -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-8918135732106370"
                        data-ad-slot="4329202681"
                        data-ad-format="auto"
                        data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

                </div><br />

                <!-- Beginning of code for tags -->
                <div class = "col-lg-12">
                    <?php include ('tags.php'); ?>
                </div>
                <!-- End of code for tags -->
            </div>
            <?php include ('sidebar2.php'); ?>

            <!-- Beginning of code for footer -->
            <?php include ('footer.php'); ?>
        </div>
    </div>
</body>
</html>