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

<body>
<?php
    include ('navbar.php');
    include ('customizedstyles.php');
    error_reporting(0);
?>

<div style = 'color: white; margin-top: 5%; text-align: center; font-size: 20px;'>
        <?php 
        include ('database/connection.php');
        session_start(); 
        if($_GET['email'] != ''){
            $sql1 = "SELECT * FROM subscribers";
            $result1 = $pdo->query($sql1);
            while ($row = $result1->fetch()){
                if ($row['email'] == $email){
                    echo "<p style = 'background-color: red; color:white;'>Sorry, that email was already used to subscribe!</p>";
                    exit();
                }
            }

            echo "<p style = 'background-color: green; color:white;'>Thank you for subscribing</p>";
            $email = $_GET['email'];
            $sql = "SELECT * FROM unsubscribers";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()){
                if ($row['email'] == $email){
                    $sqld = "DELETE FROM unsubscribers WHERE email = '$email'";
                    $pdo->exec($sqld);
                }
            }
        }
        unset($_SESSION['subscriberemail']);
        ?>
        <?php if($_GET['id'] == "taken") echo "<p style = 'background-color: red; color:white;'>Sorry, that email was already used to subscribe!</p>";?>
</div>
</body>

<script>
    $(document).ready(function(){
        setTimeout(() => {
            window.location.href = "./latest.php";
        }, 5000);
    })
</script>
</html>