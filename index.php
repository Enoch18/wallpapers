<?php 
error_reporting(0);
include ('database/connection.php');
//include ('database/createtables.php');
session_start();

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


try{
    $num = '';
    $sql1 = "SELECT * FROM visits";
    $result = $pdo->query($sql1);
    while ($row = $result->fetch()){
        $_SESSION['visit'] = "visited";
        $num = $row['visitno'];
    }
    if($_SESSION['visit'] != "visited"){
        $visitno = 1;
        $timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO visits SET
        visitno = :visitno,
        timestamp = :timestamp
        ";
        $s = $pdo->prepare($sql);
        $s->bindValue(':visitno', $visitno);
        $s->bindValue(':timestamp', $timestamp);
        $s->execute();
    }

    if($_SESSION['visit'] == "visited"){
        $sql = "UPDATE visits SET
        visitno = :visitno
        WHERE v_id = 1
        ";
        $s = $pdo->prepare($sql);
        $s->bindValue(':visitno', $num + 1);
        $s->execute();
    }
    unset($_SESSION['visit']);
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
        </div>
    </div><br />

    <div class = "row" id = row>
            <?php include ('sidebar1.php'); ?>
            <div class = "col-lg-8" id = "col2">
                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left: -5px;">
                        <h4 id = "heading">POPULAR &nbsp&nbsp CATEGORIES</h4>
                    </div>

                    <?php 
                        try{
                            $sql10 = "SELECT DISTINCT c_id FROM frontpage";
                            $result10 = $pdo->query($sql10);
                            while($row10 = $result10->fetch()){
                                $sql1 = "SELECT * FROM details AS d, resolutions AS r, category AS c, catlink as cl 
                                WHERE c.cat_id = $row10[c_id] AND d.d_id = cl.d_id AND c.cat_id = cl.cat_id AND r.d_id = d.d_id 
                                AND r.width = '500' AND r.height = '281' LIMIT 1";
                                $result1 = $pdo->query($sql1);
                                while($row1 = $result1->fetch()){
                                $name = strtoupper($row1['cat_name']);
                                    echo "
                                        <div class = 'col-lg-12'>
                                            <h4 style = 'color: white;'>$name</h4>
                                        </div>
                                    ";
                                }
                                    
                                $sql = "SELECT DISTINCT url, r.d_id, url, liveat, width, height, tag FROM details AS d, resolutions AS r, frontpage AS f, category AS c, catlink AS cl 
                                WHERE cl.d_id = d.d_id AND cl.cat_id = c.cat_id AND cl.cat_id = '$row10[c_id]' AND f.c_id = c.cat_id 
                                AND r.d_id = d.d_id AND r.width = '500' AND r.height = '281'
                                ORDER BY d.createdat DESC LIMIT 3";
                                $result = $pdo->query($sql);
                                while($row = $result->fetch()){
                                    if($row['liveat'] <= date("Y-m-d H:i:s") || $row['liveat'] == ''){
                                        $tag = $row['tag'];
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
                                            $tagname = str_replace("-", "_", $tagname);
                                            echo"
                                            <div class = 'col-lg-4' style = 'margin-left: -5px;'>
                                                <a href = 'download.php?value$row[original_filename]'>
                                                    <img src = 'ssgrouplogin/$row[url]' alt = '$alt' class = 'img img-thumbnail' style = 'width: 100%; height: 100%;'>
                                                    <p id = 'hidden' style = text-align: center; font-size: 16px;'><i class='fa fa-download'></i> $downloads</p>
                                                </a>
                                                <h6 style = 'text-align:center; font-weight: bold; color: white;'>$tag</h6><br /><br /><br />
                                            </div>
                                            ";
                                        //}
                                    }
                                }

                                $sql2 = "SELECT * FROM details AS d, resolutions AS r, frontpage AS f, category AS c, catlink AS cl 
                                WHERE cl.d_id = d.d_id AND cl.cat_id = c.cat_id AND cl.cat_id = $row10[c_id] AND f.c_id = c.cat_id 
                                AND r.d_id = d.d_id AND r.width = '500' AND r.height = '281'  LIMIT 1";
                                $result2 = $pdo->query($sql2);
                                while($row2 = $result2->fetch()){
                                    echo "
                                    <div class = 'col-lg-12' style = 'margin-left: -5px;'>
                                        <a href = 'category.php?id=$row2[cat_id]' style = 'float: right;' id = 'viewall'>(View All)</a>
                                        <br /><hr style = 'background-color: rgb(73, 133, 204); height: 2px;'/><br />
                                    </div>
                                    ";
                                }
                            }
                        }catch(PDOException $e){
                            echo "An error occured ". $e;
                        }             
                    ?>

                    <div class = "col-lg-12" style = "margin-left: -5px;">
                        <br /><br />
                        <p style = "text-align: center;"><a href = "allcategories.php" id = "viewall">View all Categories</a></p>
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