<?php 
include ('database/connection.php');
include ('database/createtables.php');

session_start();
error_reporting(0);

try{
    $email = $_POST['email'];
    $vemail = '';
    $sql1 = "SELECT * FROM subscribers";
    $result = $pdo->query($sql1);
    while ($row = $result->fetch()){
        if($email == $row['email']){
            $vemail = $row['email'];
            //$_SESSION['failed'] = "Sorry, that email was already used to subscribe!";
            header("Location: thankyou.php?id=taken");
            exit();
        }
    }

    if(isset($_POST['submit']) && $_POST['email'] != '' && $email != $vemail){
        $timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO subscribers SET
        email = :email,
        timestamp = :timestamp
        ";
        $s = $pdo->prepare($sql);
        $s->bindValue(':email', $email);
        $s->bindValue(':timestamp', $timestamp);
        $s->execute();
        //$_SESSION['success'] = "Thank you for subscribing";
        header("Location: thankyou.php?email=$email");
        exit();
    }
}catch(PDOException $e){
    echo  "Error : " . $e;
}
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
    <title>Download All Wallpapers</title>
    <link rel="shortcut icon" href = "icons/ico.ico">
    <meta name="description" content="Your one-stop destination to download high quality wallpapers of celebrities, food, nature, vehicles, animals, 3D, abstract, and so on in HD, FHD, QHD, 4K and 5K for desktops, mobiles and tablets.">
    <meta name="keywords" content="Wallpapers, Images, Wallpaper, Image, Photos, Photo, 5K, FHD, HD, free,download,4k ultra hd,5k uhd,desktop,high quality,cute,stock,best,widescreen,HDTV,1080p full hd,720p hd">
    <meta name="robots" content="index, follow" />
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

    <div id="myModal" class="modal">
        <div class="modal-content" style = "text-align: center;">
            <img src = "icons/banner.jpg" style = "width: 100%;"><br />
            <h4>AdBlock is Enabled! Please disable AdBlock to continue using the best Wallpapers website.</h4><br />
        </div>
    </div>

    <div class = "row" id = "row">
        <?php include ('sidebar1.php'); ?>
            <div class = "col-lg-8" id = "col2">
                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left: -5px;">
                        <h4 id = "heading">LATEST WALLPAPERS</h4>
                    </div>
                    <?php 
                        $downloads = 0;
                        try{
                            $total = $pdo->query('SELECT COUNT(*) FROM details')->fetchColumn();
                            if (isset($_GET['pageno'])) {
                            $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            $prev = $pageno - 1;
                            $next = $pageno + 1;
                            $no_of_records_per_page = 12;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $pages = ceil($total/$no_of_records_per_page);

                            $sql = "SELECT * FROM details AS d, resolutions AS r
                            WHERE r.d_id = d.d_id
                            AND r.width = '500' AND r.height = '281'
                            ORDER BY d.createdat DESC
                            LIMIT $offset, $no_of_records_per_page";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                if($row['liveat'] <= date("Y-m-d H:i:s") || $row['liveat'] == ''){
                                    // $sqli = "SELECT * FROM resolutions WHERE d_id = '$row[d_id]' AND original = 'original'";
                                    // $resulti = $pdo->query($sqli);
                                    // while($rowi = $resulti->fetch()){
                                        $downloads = 0;
                                        $sqld = "SELECT * FROM downloads WHERE d_id = '$row[d_id]'";
                                        $resultd = $pdo->query($sqld);
                                        $number = array();
                                        while ($rowd = $resultd->fetch()){
                                            $downloads = $rowd['counter'];
                                        }
                                        if($downloads >= 1000){
                                            $downloads = $downloads/1000;
                                            $downloads = number_format($downloads, 1) . "k";
                                        }

                                        if($downloads >= 1000000){
                                            $downloads = $downloads/1000000;
                                            $downloads = number_format($downloads, 1) . "M";
                                        }

                                        $tdid = $row['d_id'];
                                        $arr = array();
                                        $sqlt = "SELECT * FROM tagdetails WHERE d_id = '$tdid'";
                                        $resultt = $pdo->query($sqlt);
                                        while ($rowt = $resultt->fetch()){
                                            $arr[] = $rowt['tagname'];
                                        }
                                        $alt = implode(",", $arr);
                                        $tagname = str_replace(" ", "_", $row['tag']);

                                        echo"
                                        <div class = 'col-lg-4' style = 'margin-left: -5px;'>
                                        <a href = 'download.php?value=$row[original_filename]'>
                                            <img src = 'ssgrouplogin/$row[url]' class = 'img img-thumbnail' alt = '$alt' style = 'width: 100%; height: 100%;'>
                                            <p id = 'hidden'><i class='fa fa-download'></i> $downloads</p>
                                            <h5 style = 'text-align: center; color: white;'>$row[tag]</h5><br /><br /><br />
                                        </a>
                                        </div>";
                                    //}
                                }
                            }
                        }catch(PDOException $e){
                            echo "An error occured ". $e;
                        }
                    ?>
                
                    <!-- Beginnig of Code for Page Numbers -->
                    <div class = "col-lg-12" id = "#_">
                        <?php include ('pagination.php'); ?>
                    </div>
                    <!-- End of Code for Page Numbers -->

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

<script>
    $(document).ready(function(){
        setTimeout(() => {
            if ($(".ads").height() < 80){
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
            }
        }, 2000);
    });
</script>