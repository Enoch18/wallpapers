<?php 
include ('database/connection.php');
session_start();
error_reporting(0);
$original_filename = $_GET['value'];

$id = '';
$itexists = '';
try{
    $sql = "SELECT * FROM details WHERE original_filename = '$original_filename'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $id = $row['d_id'];
        $itexists = 'yes';
    }
}catch(PDOException $e){
    echo "Error " . $e;
}

if ($itexists == ''){
    header ("Location: ./notfound.php");
}

$authorlink = '';
$author = '';
$number = array();
$downloads = '';

session_start();

try{
    $d_num = array();
    $d_total = '';
    $sql = "SELECT * FROM downloads WHERE d_id = '$id'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $d_num[] = $row['d_id'];
        $itexists = "yes";
    }
    $d_total = count($d_num);
    
    if ($d_total == 0){
        $sql1 = "UPDATE details SET
        downloads = :downloads
        WHERE d_id = '$id'
        ";
        $s1 = $pdo->prepare($sql1);
        $s1->bindValue(':downloads', 1);
        $s1->execute();
    }else{
        $sql1 = "UPDATE details SET
        downloads = :downloads
        WHERE d_id = '$id'
        ";
        $s1 = $pdo->prepare($sql1);
        $s1->bindValue(':downloads', $d_total + 1);
        $s1->execute();
    }
}catch(PDOException $e){
    echo "Error " . $e;
}

try{
    $email = $_POST['email'];
    $vemail = '';
    $sql1 = "SELECT * FROM subscribers";
    $result = $pdo->query($sql1);
    while ($row = $result->fetch()){
        if($email == $row['email']){
            $vemail = $row['email'];
            //$_SESSION['failed'] = "Sorry, that email was already used to subscribe!";
            header("Location: thankyou.php?id=0");
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
        header("Location: thankyou.php?id=1");
        exit();
    }
}catch(PDOException $e){
    echo  "Error : " . $e;
}

try{
    $sql = "SELECT * FROM downloads WHERE d_id = '$id'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $downloads = $row['counter'];
    }

} catch(PDOException $e){
    echo "Error " . $e;
}

try{
    $sql = "SELECT * FROM details WHERE d_id = '$id'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $author = $row['author'];
        $authorlink = $row['link'];
    }

} catch(PDOException $e){
    echo "Error " . $e;
}


if (isset($id)){
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $sql = "SELECT * FROM downloads";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        if($row['d_id'] == $id){
            $sql1 = "UPDATE downloads SET
            counter = :counter
            WHERE d_id = $id
            ";
            $s = $pdo->prepare($sql1);
            $s->bindValue(':counter', $row['counter'] + 1);
            $s->execute();
            $_SESSION['equality'] = "equal";
        }
    }

    if($_SESSION['equality'] != "equal"){
        $sql1 = "INSERT INTO downloads SET
            downloadno = :downloadno,
            d_id = :id,
            date = :date,
            counter = :counter,
            time = :time
        ";
        $s = $pdo->prepare($sql1);
        $s->bindValue(':downloadno', $downloadno);
        $s->bindValue(':id', $id);
        $s->bindValue(':counter', 1);
        $s->bindValue(':date', $date);
        $s->bindValue(':time', $time);
        $s->execute();
    }
    unset($_SESSION['equality']);
}


$category = '';
$subcategory = '';
$multicat = array();
$ddid = '';
try{
    $sql = "SELECT * FROM details AS d, category AS c, catlink AS cl WHERE d.d_id = cl.d_id AND c.cat_id = cl.cat_id AND d.d_id = '$id'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $category = $row['cat_name'];
        $ddid = $row['d_id'];
    }
}catch(PDOException $e){
    echo "Error " . $e;
}

try{
    $sql = "SELECT * FROM category AS c, catlink AS cl WHERE cl.d_id = '$ddid' AND cl.cat_id = c.cat_id";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $multicat[] = $row['cat_name'];
    }
}catch(PDOException $e){
    echo "Error " . $e;
}

try{
    $sql = "SELECT * FROM details AS d, subcategory AS s, subcatlink AS sl WHERE d.d_id = sl.d_id AND s.sub_id = sl.sub_id AND d.d_id = '$id'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $subcategory = $row['sub_name'];
    }
}catch(PDOException $e){
    echo "Error " . $e;
}

if($downloads >= 1000){
    $downloads = $downloads/1000;
    $downloads = number_format($downloads, 1) . "k";
}

if($downloads >= 1000000){
    $downloads = $downloads/1000000;
    $downloads = number_format($downloads, 1) . "M";
}

$image1 = '';
try{
$sql = "SELECT * FROM resolutions
WHERE d_id = '$id'
AND width = '1920' AND height = '1080'";
$result = $pdo->query($sql);
while($row = $result->fetch()){
    $image1 = $row['url'];
}
}catch(PDOException $e){
    echo "error ". $e;
}
$image1 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images[0]");

$title = '';
try{
    $sql = "SELECT * FROM details WHERE d_id = '$id'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $title = $row['tag'];
    }
}catch(PDOException $e){
    echo "Error " . $e;
}

$arr = array();
$sqlt = "SELECT * FROM tagdetails WHERE d_id = '$id'";
$resultt = $pdo->query($sqlt);
while ($rowt = $resultt->fetch()){
    if ($rowt['alt'] == '1'){
        $arr[] = $rowt['tagname'];
    }
}
$alt = implode(" ", $arr);
$dscralt = implode(",", $arr);
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
    <title><?php echo $alt; ?></title>
    <link rel="shortcut icon" href = "icons/ico.ico">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <meta name="description" content="<?php echo $dscralt; ?>">
    <meta name="keywords" content="Wallpapers, Images, Wallpaper, Image, Photos, Photo, 5K, FHD, HD, free,download,4k ultra hd,5k uhd,desktop,high quality,cute,stock,best,widescreen,HDTV,1080p full hd,720p hd">
    <meta name="robots" content="index, follow" />
    <script src = "assets/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="assets/css/global.css" rel="stylesheet">
    <link href="assets/css/stylesheet.css" rel="stylesheet">
    <link href="assets/css/responsiveness.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arimo&display=swap" rel="stylesheet">

    <style type="text/css">
 
    #share-buttons img {
    width: 35px;
    padding: 5px;
    border: 0;
    box-shadow: 0;
    display: inline;
    }

    .tags{
        height: 40px; 
        margin-top: 7px; 
        font-size: 14pt; 
        font-weight: bold; 
        background-color: rgb(75, 74, 74); 
        display: inline; 
        color: rgb(73, 133, 204) !important;
    }

    .tags:hover{
        font-size: 15pt; 
        opacity: 0.8;
    }
    
    @media (max-width: 769px){
        #share-buttons {
            margin-left: -68% !important;
        }
    }
    </style>



</head>

<script>
$(document).ready(function(){
    $('#subscribe').hide();
    $('#subbtn').click(function($e){
        $e.preventDefault();
        $('#subbtn').hide();
        $('#subscribe').show();
    });

    // $('.down').click(function(){
    //     $.ajax({
    //         url: 'download.php',
    //         data: 'download='+ encodeURIComponent(1) + '&iid='+ encodeURIComponent('<?php echo $id; ?>'),
    //         success: function(data){
                
    //         }
    //     })
    // });
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
                    <?php
                        try{
                            $addedon = '';
                            $description = '';
                            $name = '';
                            $sql = "SELECT * FROM details AS d, resolutions AS r
                            WHERE d.d_id = '$id'
                            AND r.d_id = d.d_id AND r.width = '1920' AND r.height = '1080'";

                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                $addedon = $row['createdat'];
                                $description = $row['description'];
                                $name = $row['tag'];

                                $tdid = $row['d_id'];
                                $arr = array();
                                $sqlt = "SELECT * FROM tagdetails WHERE d_id = '$tdid'";
                                $resultt = $pdo->query($sqlt);
                                while ($rowt = $resultt->fetch()){
                                    $arr[] = $rowt['tagname'];
                                }
                                $alt = implode(",", $arr);

                                if($category != '' && $subcategory != ''){
                                    $img = str_replace("../", "", $row['url']);
                                    $server = $_SERVER['SERVER_NAME'];
                                    if ($server == 'localhost'){
                                        $server = "http://" . $server . "/wallpapers";
                                    }else{
                                        $server = "http://" . $_SERVER['SERVER_NAME'];
                                    }

                                    echo"
                                    <div class = 'col-lg-12'>
                                        <div class = 'col-lg-12' id = 'addedonheader'>
                                            <h4><a href = 'searchresults.php?search=$category' style = 'color:white'> $category </a>  >  $subcategory</h4>
                                        </div></div>
                                    <br />

                                    <div class = 'col-lg-12' id = 'imagedownload'>
                                        <a href = '$server/$img' class = 'down' style = 'width: 95%;'>
                                            <img src = 'ssgrouplogin/$row[url]' class = 'img-thumbnail' alt='$alt' style = 'width: 100%; height: 100%;' title = '$alt'><br /><br />
                                        </a>
                                    </div>";
                                }

                                if($category != '' && $subcategory == ''){
                                    $img = str_replace("../", "", $row['url']);
                                    $server = $_SERVER['SERVER_NAME'];
                                    if ($server == 'localhost'){
                                        $server = "http://" . $server . "/wallpapers";
                                    }else{
                                        $server = "http://" . $_SERVER['SERVER_NAME'];
                                    }

                                    echo"
                                    <div class = 'col-lg-12'>
                                        <div class = 'col-lg-12' id = 'addedonheader'>
                                            <h4><a href = 'searchresults.php?search=$category' style = 'color:white'> $category </a></h4>
                                        </div></div>
                                    <br />

                                    <div class = 'col-lg-12' id = 'imagedownload'>
                                        <a href = '$server/$img' class = 'down' style = 'width: 95%;'>
                                            <img src = 'ssgrouplogin/$row[url]' class = 'img-thumbnail' alt = '$alt' style = 'width: 100%; height: 100%;' title = '$alt'><br /><br />
                                        </a>
                                    </div>";
                                }

                                if($category == '' && $subcategory != ''){
                                    $img = str_replace("../", "", $row['url']);
                                    $server = $_SERVER['SERVER_NAME'];
                                    if ($server == 'localhost'){
                                        $server = "http://" . $server . "/wallpapers";
                                    }else{
                                        $server = "http://" . $_SERVER['SERVER_NAME'];
                                    }

                                    echo"
                                    <div class = 'col-lg-12'>
                                        <div class = 'col-lg-12' id = 'addedonheader'>
                                            <h4>$subcategory</h4>
                                        </div></div>
                                    <br />

                                    <div class = 'col-lg-12' id = 'imagedownload'>
                                        <a href = '$server/$img' class = 'down' style = 'width: 95%;'>
                                            <img src = 'ssgrouplogin/$row[url]' class = 'img-thumbnail' alt = '$alt' style = 'width: 100%; height: 100%;' title = '$alt'><br /><br />
                                        </a>
                                    </div>";
                                }

                                if($category == '' && $subcategory == ''){
                                    $img = str_replace("../", "", $row['url']);
                                    $server = $_SERVER['SERVER_NAME'];
                                    if ($server == 'localhost'){
                                        $server = "http://" . $server . "/wallpapers";
                                    }else{
                                        $server = "http://" . $_SERVER['SERVER_NAME'];
                                    }

                                    echo"
                                    <div class = 'col-lg-12'>
                                        <div class = 'col-lg-12' id = 'addedonheader'>
                                            <h4>$row[tag]</h4>
                                        </div></div>
                                    <br />

                                    <div class = 'col-lg-12' id = 'imagedownload'>
                                        <a href = '$server/$img' class = 'down' style = 'width: 95%;'>
                                            <img src = 'ssgrouplogin/$row[url]' class = 'img-thumbnail' alt = '$alt' style = 'width: 100%; height: 100%;' title = '$alt'><br /><br />
                                        </a>
                                    </div>";
                                }
                            }
                        }catch(PDOException $e){
                            echo "An error occured ". $e;
                        }
                    ?>

                    <div class = "col-lg-12">
                        <h5 style = "margin-left: 6.5%; color: white; text-align: center;"><b style = "font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600; color: #FCFF00;">Name:</b><br /> <?php echo $name; ?></h5>
                    </div>

                    <div class = "col-lg-12">
                        <?php if($downloads == ''){
                            $downloads = 0;
                        } ?>
                        <h5 style = "margin-left: 6.5%; color: white; text-align: center;"><b style = "font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600; color: #FCFF00;">Downloads:</b><br /> <?php echo $downloads; ?></h5>
                    </div>

                    <div class = "col-lg-12">
                        <h5 style = "margin-left: 6.5%; color: white; text-align: center; text-align: center;"><b style = "font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600; color: #FCFF00;">Added on:</b><br /> <?php echo $addedon; ?></h5>
                    </div>

                    <div class = "col-lg-12">
                        <h5 style = "margin-left: 6.5%; color: white; text-align: center;"><b style = "font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600; color: #FCFF00;">Category:</b> <br />
                            <?php 
                                for($i=0; $i < count($multicat); $i++){
                                    echo "<a href='searchresults.php?search=$multicat[$i]'>" . $multicat[$i] ."</a>&nbsp&nbsp&nbsp&nbsp&nbsp";
                                }
                            ?>  
                        </h5>
                    </div>

                    <div class = "col-lg-12">
                        <h5 style = "margin-left: 6.5%; color: white; text-align: center;"><b style = "font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600; color: #FCFF00;">Description:</b><br /> <?php echo $description; ?></h5>
                    </div>

                    <!-- Beginning Wallpaper Tags -->
                    <div style = "text-align: center; width: 100%;">
                        <h5 style = "margin-left: 6.5%; color: white;"><b style = "font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600; color: #FCFF00;">Tags:&nbsp;</b></h5>
                        <div style = "text-align: center; width: 100%;">
                            <?php 
                                $tags = array();
                                $count = '';
                                $colors = array("#00a2ed", "#00a550", "#00ff00", "#1c39bb"," #6ca0dc", "#6f00ff", "#9c51b6", "#15f2fd", "#66c992", "#80daeb", "#c1f9a2", "#cae00d", "#cc99ff", "#e3ff00", "#f64a8a");

                                try{
                                    $sql = "SELECT * FROM tagdetails WHERE d_id = '$id' ORDER BY id ASC LIMIT 10";
                                    $result = $pdo->query($sql);
                                    while($row = $result->fetch()){
                                        if ($row['alt'] != '1'){
                                            $color = $colors[rand(0, 14)];
                                            echo"
                                                <a href = 'searchresults.php?search=$row[tagname]' class = 'tags' style = 'text-align: center; color: $color !important;'>
                                                    $row[tagname] &nbsp;
                                                </a>
                                            ";
                                        }
                                    }
                                }catch(PDOException $e){
                                    echo "An error occured" . $e;
                                }
                            ?>
                        </div>
                    </div>
                    <!-- End of Wallpaper Tags -->

                    <div class = "col-lg-12">
                            <?php
                                echo "<br />";
                                if($author != '')echo "<h5 style = 'margin-left: 6.5%; color: white;'>Author: ";
                                if($authorlink != '' && $author != '') echo "<a href = 'https://$authorlink' target = '_black'><u>$author</u></a>"; 
                                if($authorlink == '') echo "<a href = '#'>$author</a>"; 
                                echo "</h5>";
                            ?>
                    </div>

                    <div class = "col-lg-12">
                        <div id = "resolutions">
                            <br />
                            <div class = "row">
                                <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <p style = "margin-left: 3%; text-align: center; font-size: 16pt;"><i class="fa fa-download"></i> Download this wallpaper from the following resolutions</p>
                                </div>
                            </div>
                            <?php
                                echo"
                                <div class = 'col-lg-12'>
                                <h5 style = 'margin-left: 3%; color: white; text-align: center;'>";
                                try{
                                    $sql = "SELECT * FROM details AS d, resolutions AS r
                                    WHERE d.d_id = '$id'
                                    AND r.d_id = d.d_id AND r.width = '1280' AND r.height = '720' AND active = '1'";

                                    $result = $pdo->query($sql);
                                    while($row = $result->fetch()){
                                        echo"
                                        <a href = 'ssgrouplogin/$row[url]' download = '$row[filestore].jpg' class = 'down' style = 'font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600;'>1280 x 720 (HD) $row[filesize]</a> <br /><br />";
                                    }

                                    $sql1 = "SELECT * FROM details AS d, resolutions AS r
                                    WHERE d.d_id = '$id'
                                    AND r.d_id = d.d_id AND r.width = '1920' AND r.height = '1080' AND active = '1'";
                                    $result1 = $pdo->query($sql1);
                                    while($row1 = $result1->fetch()){
                                        echo"
                                        <a href = 'ssgrouplogin/$row1[url]' download = '$row1[filestore].jpg' class = 'down' style = 'font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600;'>1920 x 1080 (FHD) $row1[filesize]</a> <br /><br />";
                                    }

                                    $sql2 = "SELECT * FROM details AS d, resolutions AS r
                                    WHERE d.d_id = '$id'
                                    AND r.d_id = d.d_id AND r.width = '2560' AND r.height = '1440' AND active = '1'";
                                    $result2 = $pdo->query($sql2);
                                    while($row2 = $result2->fetch()){
                                        echo"
                                        <a href = 'ssgrouplogin/$row2[url]' download = '$row2[filestore].jpg' class = 'down' style = 'font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600;'>2560 x 1440 (QHD) $row2[filesize]</a> <br /><br />";
                                    }

                                    $sql3 = "SELECT * FROM details AS d, resolutions AS r
                                    WHERE d.d_id = '$id'
                                    AND r.d_id = d.d_id AND r.width = '3840' AND r.height = '2160' AND active = '1'";
                                    $result3 = $pdo->query($sql3);
                                    while($row3 = $result3->fetch()){
                                        echo"
                                        <a href = 'ssgrouplogin/$row3[url]' download = '$row3[filestore].jpg' class = 'down' style = 'font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600;'>3840 x 2160 (4K) $row3[filesize]</a> <br /><br />";
                                    }

                                    $sql4 = "SELECT * FROM details AS d, resolutions AS r
                                    WHERE d.d_id = '$id'
                                    AND r.d_id = d.d_id AND r.width = '5120' AND r.height = '2880' AND active = '1'";
                                    $result4 = $pdo->query($sql4);
                                    while($row4 = $result4->fetch()){
                                        echo"
                                        <a href = 'ssgrouplogin/$row4[url]' download = '$row4[filestore].jpg' class = 'down' style = 'font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600;'>5120 x 2880 (5K) $row4[filesize]</a> <br /><br />";
                                    }

                                    // $sql5 = "SELECT * FROM details AS d, resolutions AS r
                                    // WHERE d.d_id = '$id'
                                    // AND r.d_id = d.d_id AND r.width = '7680' AND r.height = '4320'";
                                    // $result5 = $pdo->query($sql5);
                                    // while($row5 = $result5->fetch()){
                                    //     echo"
                                    //     <a href = 'ssgrouplogin/$row5[url]' download = '$row5[name]' class = 'down' style = 'font-family: Ubuntu, serif; font-size: 16pt; font-weight: 600;'>7680 x 4320 (8K)</a> <br /><br />";
                                    // }
                                    echo"
                                    </h5><br />
                                    </div>";      
                                    
                                }catch(PDOException $e){
                                    echo "An error occured ". $e;
                                }
                            ?>
                        </div><br /><hr />

                        <div id = "ad">
                            <p>Advertisement</p>
							<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({
                                    google_ad_client: "ca-pub-8918135732106370",
                                    enable_page_level_ads: true
                                });
                            </script>
                        </div><br />

                        <div class = "row" style = "width: 100%; margin-left: 0px;">
                            <h4 id = "relatedtext" style = "font-size: 20px !important">Related Wallpapers</h4>
                            <?php 
                                try{
                                    $sql = "SELECT DISTINCT r.d_id, r.url, r.width, r.height, d.d_id, original_filename, d.tag, liveat, da.counter FROM details AS d, resolutions AS r, category AS c, catlink AS cl, downloads AS da
                                    WHERE c.cat_name = '$category' AND d.d_id != '$id' AND cl.d_id = d.d_id AND c.cat_id = cl.cat_id AND da.d_id = d.d_id
                                    AND r.d_id = d.d_id AND r.width = '1280' AND r.height = '720' 
                                    ORDER BY da.counter DESC LIMIT 3";
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
                                                    $downloads = $total/1000;
                                                    $downloads = number_format($total, 1) . "k";
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
                                                    <p id = 'hidden'><i class='fa fa-download'></i> $downloads</p><br />
                                                    <h5 style = 'text-align: center; color: white;'>$row[tag]</h5><br /><br />
                                                </a>
                                                </div>";
                                                $celcatid = $row['cat_id'];
                                            //}
                                        }
                                    }
                            }catch(PDOException $e){
                                echo "An error occured ". $e;
                            }
                        ?>
                        </div><br /><br />
                    </div><br /><br />

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

                <div class = "col-lg-12">
                    <?php include ('tags.php'); ?>
                </div>
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
        }, 500);
    });
</script>