<?php 
error_reporting(0);
include ('database/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Your one-stop destination to download high quality wallpapers of celebrities, food, nature, vehicles, animals, 3D, abstract, and so on in HD, FHD, QHD, 4K and 5K for desktops, mobiles and tablets.">
    <meta name="keywords" content="Wallpapers, Images, Wallpaper, Image, Photos, Photo, 5K, FHD, HD, free,download,4k ultra hd,5k uhd,desktop,high quality,cute,stock,best,widescreen,HDTV,1080p full hd,720p hd">
    <meta name="robots" content="index, follow" />
    <title>Incredible Wallpapers</title>
    <link rel="shortcut icon" href = "icons/Fevicon.ico">
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
        <?php 
            include ('navbar.php'); 
            include ('customizedstyles.php');
        ?>

        <div id = "ads" class = 'ads' style = "margin-left: auto !important; margin-right: auto !important;">
            <p>Advertisement</p>
        </div>
    </div><br />

    <!-- <div id="myModal" class="modal">
        <div class="modal-content" style = "text-align: center;">
            <img src = "icons/banner.jpg" style = "width: 100%;"><br />
            <h4>AdBlock is Enabled! Please disable AdBlock to continue using the best Wallpapers website.</h4><br />
        </div>
    </div> -->

    <div class = "row">
            <?php include ('sidebar1.php'); ?>
            <div class = "col-lg-8 activetags" id = "col2">
                <div class = "row" style = "color: white !important;">
                    <div class = "col-lg-12" style = "margin-left: -5px;">
                        <h4 id = "heading">ACTIVE TAGS</h4>
                    </div><br /><br /><br /><br />

                    <?php
                        try{
                            $colors = array("#00a2ed", "#00a550", "#00ff00", "#1c39bb"," #6ca0dc", "#6f00ff", "#9c51b6", "#15f2fd", "#66c992", "#80daeb", "#c1f9a2", "#cae00d", "#cc99ff", "#e3ff00", "#f64a8a");
                            echo "
                            <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <div class = 'row'>
                            ";
                            foreach (range('A', 'Z') as $letters){
                                echo "<div class = 'col-xs-1 col-sm-2 col-md-2 col-lg-2' style = 'width: 20%;'>";
                                    $num = array();
                                    $sql1 = "SELECT DISTINCT tagname FROM tagdetails WHERE tagname LIKE '$letters%' AND alt != '1'";
                                    $result1 = $pdo->query($sql1);
                                    while($row1 = $result1->fetch()){
                                        $num[] = $row1['tagname'];
                                    }
                                    $total = count($num);

                                    echo "<span id = '$letters' class = 'letters'>$letters ($total)<br /><br /><br />";
                                echo "</div>";
                            }
                            echo "</div></div><br /><br /><br />";

                            foreach (range('A', 'Z') as $letters2){
                                echo "<div id = 'letter$letters2' class = 'alpcontainer' style = 'display: none; margin-top: 10px;'>";
                                $sql = "SELECT DISTINCT tagname FROM tagdetails  WHERE alt != '1' AND tagname LIKE '$letters2%' GROUP BY tagname ORDER BY tagname ASC";
                                $result = $pdo->query($sql);
                                while($row = $result->fetch()){
                                    $tag = $row['tagname'];
                                    $num = array();
                                    $sql1 = "SELECT * FROM tagdetails WHERE tagname LIKE '$tag' AND alt != '1'";
                                    $result1 = $pdo->query($sql1);
                                    while($row1 = $result1->fetch()){
                                        $num[] = $row1['id'];
                                    }
                                    $count = count($num);
                                    $color = $colors[rand(0, 14)];

                                    echo "
                                        <a href = './searchresults.php?search=$row[tagname]' class = 'mainalttags' style = 'text-decoration: none; color: $color !important;'>
                                            $row[tagname] ($count)&nbsp&nbsp&nbsp&nbsp&nbsp
                                        </a>
                                    ";
                                }
                                echo "</div>";
                            }
                        }catch(PDOException $e){
                            echo "An error occured. " .$e;
                        }
                    ?>
                </div><br /><br />

                    
                <div id = "ad">
                    <p>Advertisement</p>
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

<script>
    $(document).ready(function(){
        // setTimeout(() => {
        //     if ($(".ads").height() < 80){
        //         var modal = document.getElementById("myModal");
        //         modal.style.display = "block";
        //     }
        // }, 500);

        $("#letterA").show();
        $(".letters").click(function(){
            let letter = this.id;
            $(".alpcontainer").hide();
            $("#letter" + letter).show();
        });
    });
</script>