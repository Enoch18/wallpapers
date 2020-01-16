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

if (isset($_GET['pageno'])) {
$pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

if (isset($_GET['pageno1'])) {
$pageno1 = $_GET['pageno1'];
} else {
    $pageno1 = 1;
}

$catname = $_GET['catname'];
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
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <meta name="description" content="Your one-stop destination to download high quality wallpapers of celebrities, food, nature, vehicles, animals, 3D, abstract, and so on in HD, FHD, QHD, 4K and 5K for desktops, mobiles and tablets.">
    <meta name="keywords" content="Wallpapers, Images, Wallpaper, Image, Photos, Photo, 5K, FHD, HD, free,download,4k ultra hd,5k uhd,desktop,high quality,cute,stock,best,widescreen,HDTV,1080p full hd,720p hd">
    <meta name="robots" content="index, follow" />
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
</script>
        </div>
    </div><br />
    <div class = "row" id = "row">
        <?php include ('sidebar1.php'); ?>
            <div class = "col-lg-8" id = "col2">
                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left: -5px;">
                    <?php 
                        $id = $_GET['id'];
                        try{
                            $sql = "SELECT * FROM details AS d, category AS c, catlink AS cl 
                            WHERE cl.d_id = d.d_id AND cl.cat_id = c.cat_id AND c.cat_id = '$id' LIMIT 1";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                echo"
                                <div class = 'row'>
                                    <div class = 'col-lg-12' style = 'margin-left: -5px;'>
                                        <h4 style = 'margin-left: 10px;' id= 'heading'>" . strtoupper($row['cat_name']) . "</h4>
                                    </div>
                                </div>";
                            }

                            $total1 = $pdo->query("SELECT COUNT(*) FROM subcategory WHERE cat_id = '$id'")->fetchColumn();
                            if (isset($_GET['pageno1'])) {
                            $pageno1 = $_GET['pageno1'];
                            } else {
                                $pageno1 = 1;
                            }
                            $prev1 = $pageno1 - 1;   
                            $next1 = $pageno1 + 1;
                            $no_of_records_per_page1 = 30;
                            $offset1 = ($pageno1-1) * $no_of_records_per_page1;
                            $pages1 = ceil($total1/$no_of_records_per_page1);
                            
                            echo "<div class = 'col-lg-12'><div class = 'row'>";
                            $sql1 = "SELECT * FROM subcategory 
                            WHERE cat_id = '$id'
                            ORDER BY sub_name ASC
                            LIMIT $offset1, $no_of_records_per_page1
                            ";
                            $result1 = $pdo->query($sql1);
                            while($row1 = $result1->fetch()){
                                $total = $pdo->query("SELECT COUNT(*) FROM details AS d, subcatlink AS sl 
                                WHERE d.d_id = sl.d_id AND sl.sub_id = '$row1[sub_id]'")->fetchColumn();
                                if($total >= 1000){
                                    $total = $total/1000;
                                    $total = number_format($total, 1) . "k";
                                }

                                if($total >= 1000000){
                                    $total = $total/1000000;
                                    $total = number_format($total, 1) . "M";
                                }
                                echo"
                                    <a href = 'searchresults.php?search=$row1[sub_name]' class = 'btn btn-secondary' style = 'width: 100%; margin-left: 1px; 
                                    background-color: rgb(73, 133, 204); color: white; border: 1px solid rgb(73, 133, 204); width: 15%; margin-top: 10px;'>
                                    $row1[sub_name] ($total)</a> &nbsp&nbsp&nbsp&nbsp";
                            }
                            echo "</div></div><br />";
                    }catch(PDOException $e){
                        echo "An error occured : " . $e;
                    }
                    ?>
                    </div>

                    <!-- Beginnig of Code for Subcategory Page Numbers -->
                    <div class = "col-lg-12" id="#_">
                        <div class = "container" id = "pages">
                            <?php if ($pages1 == 1 && !($pages1 > 1)){ ?>
                            <br />
                            <!-- <ul class = "pagination">           
                                <li><a href = "#_" class = "btn btn-primary">First</a></li>
                                <li><a href = "?pageno=<?php //echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php //echo $pageno ?></a></li>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p></li>
                                <li><a href = "?pageno=<?php //echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php //echo $pages ?></a></li>
                                <?php
                                    // if ($pages == 1 && !($pages > 1)){
                                    //     echo "<li><a href = '#_' class = 'btn btn-primary' style = 'margin-left: 20px; color:white;'>Last</a></li>";
                                    // }
                                ?>
                            </ul> -->
                            <?php } ?>

                            <?php if ($pages1 > 1 && $pageno1 < $pages1){ ?>
                                <br />
                                <ul class = "pagination"> 
                                <?php if ($pageno1 == 1){ ?>          
                                    <li><a href = "#_" class = "btn btn-primary" style = "color: white;">First</a>
                                <?php } ?>

                                <?php if ($pageno1 > 1){ ?>          
                                    <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1 - 1; ?>&pageno=<?php echo $pageno; ?>" class = "btn btn-primary"><<< </a>
                                <?php } ?>
                                <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1; ?>&pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno1 ?></a></li>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p></li>
                                <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pages1; ?>&pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages1 ?></a></li>
                                <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1 + 1; ?>&pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px;'>>>> </a></li>
                                </ul>
                            <?php } ?>

                            <?php if ($pageno1 == $pages1 && $pages1 != 1){ ?>
                                <br />
                                <ul class = "pagination">           
                                    <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1 - 1; ?>&pageno=<?php echo $pageno; ?>" class = "btn btn-primary"> <<< </a>
                                    <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1; ?>&pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno1 ?></a></li>
                                    <li style = "color: black !important;"><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p></li>
                                    <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pages1; ?>&pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages1 ?></a></li>
                                    <li><a href = "#_" class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a></li>
                                </ul>
                            <?php } ?>

                            <?php if ($pages1 == 0 || $pages1 < 0){ ?>                                
                                <?php } ?>
                            </div><br /><br />
                        </div>
                        <!-- End of Code for Subcategory Page Numbers -->

                    <?php 
                        $id = $_GET['id'];
                        try{

                            $total = $pdo->query("SELECT COUNT(*) FROM details AS d, catlink AS cl WHERE d.d_id = cl.d_id AND cl.cat_id = '$id'")->fetchColumn();
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

                            $sql = "SELECT * FROM details AS d, resolutions AS r, category AS c, catlink AS cl 
                            WHERE cl.d_id = d.d_id AND cl.cat_id = c.cat_id AND cl.cat_id = '$id'
                            AND r.d_id = d.d_id AND r.width = '500' AND r.height = '281'
                            ORDER BY d.createdat DESC
                            LIMIT $offset, $no_of_records_per_page";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                if($row['liveat'] < date("Y-m-d H:i:s") || $row['liveat'] == ''){
                                    // $sqli = "SELECT * FROM resolutions WHERE d_id = '$row[d_id]' AND original = 'original'";
                                    // $resulti = $pdo->query($sqli);
                                    //while($rowi = $resulti->fetch()){
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
                                        $tagname = str_replace("-", "_", $tagname);

                                        echo"
                                        <div class = 'col-lg-4' style = 'margin-left: -5px;'>
                                        <a href = 'download.php?value=$row[original_filename]'>
                                            <img src = 'ssgrouplogin/$row[url]' class = 'img img-thumbnail' alt = '$alt' style = 'width: 100%; height: 100%;'>
                                            <p id = 'hidden' style = 'font-size: 16px;'><i class='fa fa-download'></i> $downloads</p>
                                            <h5 style = 'text-align: center; color: white;'>$row[tag]</h5>
                                            <br /><br /><br />
                                        </a>
                                        </div>";
                                    // }
                                }
                            }
                        }catch(PDOException $e){
                            echo "An error occured ". $e;
                        }
                    ?>

                        <!-- Beginnig of Code for Page Numbers -->
                        <div class = "col-lg-12" id = "#_">
                        <div class = "container" id = "pages">
                        <?php if ($pages == 1 && !($pages > 1)){ ?>
                            <!-- <br />
                            <ul class = "pagination">           
                                <li><a href = "#_" class = "btn btn-primary">First</a>
                                <li><a href = "?id=<?php //echo $id; ?>&catname=<?php //echo $catname; ?>&pageno1=<?php //echo $pageno1; ?>&pageno=<?php //echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php //echo $pageno ?></a>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p>
                                <li><a href = "?id=<?php //echo $id; ?>&catname=<?php //echo $catname; ?>&pageno1=<?php //echo $pageno1; ?>&pageno=<?php //echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php //echo $pages ?></a><li>
                                <?php
                                    // if ($pages == 1 && !($pages > 1)){
                                    //     echo "<li><a href = '#_' class = 'btn btn-primary' style = 'margin-left: 20px; color:white;'>Last</a></li>";
                                    // }
                                ?>
                            </ul> -->
                        <?php } ?>

                        <?php if ($pages > 1 && $pageno < $pages){ ?>
                            <br />
                            <ul class = "pagination"> 
                                <?php if ($pageno == 1){ ?>          
                                    <li><a href = "#_" class = "btn btn-primary">First</a>
                                <?php } ?>

                                <?php if ($pageno > 1){ ?>          
                                    <li><a href = "?id=<?php echo $id; ?>&pageno=<?php echo $pageno - 1; ?>" class = "btn btn-primary"> <<< </a>
                                <?php } ?>
                                <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1; ?>&pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno ?></a>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p>
                                <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1; ?>&pageno=<?php echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages ?></a><li>
                                <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1; ?>&pageno=<?php echo $pageno + 1; ?>" class = 'btn btn-primary' style = 'margin-left: 20px;'> >>> </a>
                            </ul>
                        <?php } ?>

                        <?php if ($pageno == $pages && $pages != 1){ ?>
                            <br />
                            <ul class = "pagination">           
                                <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1; ?>&pageno=<?php echo $pageno - 1; ?>" class = "btn btn-primary"> <<< </a>
                                <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1; ?>&pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno ?></a>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p>
                                <li><a href = "?id=<?php echo $id; ?>&catname=<?php echo $catname; ?>&pageno1=<?php echo $pageno1; ?>&pageno=<?php echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages ?></a><li>
                                <li><a href = "#_" class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a>
                            </ul>
                        <?php } ?>

                        <?php if ($pages == 0 || $pages < 0){ ?>
                            <br />
                            <h5 id = "heading" style = "color: white;">No Wallpapers yet.</h5>
                        <?php } ?>
                        </div>
                        <!-- End of Code for Page Numbers -->
                    </div>


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