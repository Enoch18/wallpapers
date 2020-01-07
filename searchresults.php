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


$search = $_GET['search'];
$tagcount = $pdo->query("SELECT COUNT(*) FROM tagdetails WHERE tagname LIKE '%$search%'")->fetchColumn();
$catcount = $pdo->query("SELECT COUNT(*) FROM category WHERE cat_name LIKE '%$search%'")->fetchColumn();
$subcount = $pdo->query("SELECT COUNT(*) FROM subcategory WHERE sub_name LIKE '%$search%'")->fetchColumn();
$detcount = $pdo->query("SELECT COUNT(*) FROM details WHERE tag LIKE '%$search%'")->fetchColumn();
$total = '';
$query = '';

if ($search != ''){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r
    WHERE r.d_id = d.d_id AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 1280 && $row1['height'] == 720){
            $num[] = $row1['d_id'];
        }
    }
    $total = count($num);
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $prev = $pageno - 1;
    $next = $pageno + 1;
    $no_of_records_per_page = 12;
    $offset = ($pageno - 1) * $no_of_records_per_page;
    $pages = ceil($total/$no_of_records_per_page);

    try{
        $query = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
        FROM details AS d, resolutions AS r
        WHERE r.d_id = d.d_id AND r.width = '1280' AND r.height = '720'
        AND (d.tag LIKE '%$search%')
        ORDER BY d.createdat DESC
        LIMIT $offset, $no_of_records_per_page";
    }catch(PDOException $e){
        echo $e;
    }

if ($detcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r
    WHERE r.d_id = d.d_id AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 1280 && $row1['height'] == 720){
            $num[] = $row1['d_id'];
        }
    }
    $total = count($num);
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $prev = $pageno - 1;
    $next = $pageno + 1;
    $no_of_records_per_page = 12;
    $offset = ($pageno - 1) * $no_of_records_per_page;
    $pages = ceil($total/$no_of_records_per_page);

    try{
        $query = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
        FROM details AS d, resolutions AS r
        WHERE r.d_id = d.d_id AND r.width = '1280' AND r.height = '720'
        AND (d.tag LIKE '%$search%')
        ORDER BY d.createdat DESC
        LIMIT $offset, $no_of_records_per_page";
    }catch(PDOException $e){
        echo $e;
    }
}

if($tagcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, tagdetails AS td
    WHERE r.d_id = d.d_id AND td.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 1280 && $row1['height'] == 720){
            $num[] = $row1['d_id'];
        }
    }
    $total = count($num);
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $prev = $pageno - 1;
    $next = $pageno + 1;
    $no_of_records_per_page = 12;
    $offset = ($pageno - 1) * $no_of_records_per_page;
    $pages = ceil($total/$no_of_records_per_page);

    try{
        $query = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
        FROM details AS d, resolutions AS r, tagdetails AS td
        WHERE r.d_id = d.d_id AND td.d_id = d.d_id
        AND r.width = '1280' AND r.height = '720'
        AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%')
        ORDER BY d.createdat DESC
        LIMIT $offset, $no_of_records_per_page";
    }catch(PDOException $e){
        echo $e;
    }
}

if($catcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, catlink as cl, category AS c
    WHERE r.d_id = d.d_id AND cl.cat_id = c.cat_id AND cl.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 1280 && $row1['height'] == 720){
            $num[] = $row1['d_id'];
        }
    }
    $total = count($num);
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $prev = $pageno - 1;
    $next = $pageno + 1;
    $no_of_records_per_page = 12;
    $offset = ($pageno - 1) * $no_of_records_per_page;
    $pages = ceil($total/$no_of_records_per_page);

    $query = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, catlink as cl, category AS c
    WHERE r.d_id = d.d_id AND cl.cat_id = c.cat_id AND cl.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
}

if($subcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, subcatlink as sl, subcategory AS s
    WHERE r.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 1280 && $row1['height'] == 720){
            $num[] = $row1['d_id'];
        }
    }
    $total = count($num);
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $prev = $pageno - 1;
    $next = $pageno + 1;
    $no_of_records_per_page = 12;
    $offset = ($pageno - 1) * $no_of_records_per_page;
    $pages = ceil($total/$no_of_records_per_page);

    $query = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, subcatlink as sl, subcategory AS s
    WHERE r.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
    //echo "it is cat<br />";
}

if($catcount > 0 && $tagcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, tagdetails AS td, catlink as cl, category AS c
    WHERE r.d_id = d.d_id AND td.d_id = d.d_id AND cl.cat_id = c.cat_id AND cl.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 1280 && $row1['height'] == 720){
            $num[] = $row1['d_id'];
        }
    }
    $total = count($num);
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $prev = $pageno - 1;
    $next = $pageno + 1;
    $no_of_records_per_page = 12;
    $offset = ($pageno - 1) * $no_of_records_per_page;
    $pages = ceil($total/$no_of_records_per_page);

    $query = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, tagdetails AS td, catlink as cl, category AS c
    WHERE r.d_id = d.d_id AND td.d_id = d.d_id AND cl.cat_id = c.cat_id AND cl.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
}

if($subcount > 0 && $tagcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, tagdetails AS td, subcatlink AS sl, subcategory AS s
    WHERE r.d_id = d.d_id AND td.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%' OR s.sub_name LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 1280 && $row1['height'] == 720){
            $num[] = $row1['d_id'];
        }
    }
    $total = count($num);
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $prev = $pageno - 1;
    $next = $pageno + 1;
    $no_of_records_per_page = 12;
    $offset = ($pageno - 1) * $no_of_records_per_page;
    $pages = ceil($total/$no_of_records_per_page);

    $query = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, tagdetails AS td, subcatlink AS sl, subcategory AS s
    WHERE r.d_id = d.d_id AND td.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%' OR s.sub_name LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
}

if($subcount > 0 && $catcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, subcatlink AS sl, subcategory AS s, category AS c, catlink cl
    WHERE r.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id AND cl.d_id = d.d_id AND c.cat_id = cl.cat_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 1280 && $row1['height'] == 720){
            $num[] = $row1['d_id'];
        }
    }
    $total = count($num);
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $prev = $pageno - 1;
    $next = $pageno + 1;
    $no_of_records_per_page = 12;
    $offset = ($pageno - 1) * $no_of_records_per_page;
    $pages = ceil($total/$no_of_records_per_page);

    $query = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, subcatlink AS sl, subcategory AS s, category AS c, catlink cl
    WHERE r.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id AND cl.d_id = d.d_id AND c.cat_id = cl.cat_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
}

if($subcount > 0 && $catcount > 0 && $tagcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, subcatlink AS sl, subcategory AS s, category AS c, catlink cl, tagdetails AS td
    WHERE r.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id AND cl.d_id = d.d_id AND c.cat_id = cl.cat_id AND td.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%' OR c.cat_name LIKE '%$search%' OR td.tagname LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 1280 && $row1['height'] == 720){
            $num[] = $row1['d_id'];
        }
    }
    $total = count($num);
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $prev = $pageno - 1;
    $next = $pageno + 1;
    $no_of_records_per_page = 12;
    $offset = ($pageno - 1) * $no_of_records_per_page;
    $pages = ceil($total/$no_of_records_per_page);

    $query = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, subcatlink AS sl, subcategory AS s, category AS c, catlink cl, tagdetails AS td
    WHERE r.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id AND cl.d_id = d.d_id AND c.cat_id = cl.cat_id AND td.d_id = d.d_id
    AND r.width = '1280' AND r.height = '720'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%' OR c.cat_name LIKE '%$search%' OR td.tagname LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
}
}
$searchresulttotal = $total;
?>

<!DOCTYPE html>
<html lang="en">
<head>
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

        <div id = "ads">
            <p>Advertisement</p>
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

    <div class = "row" id = "row">
        <?php include ('sidebar1.php'); ?>
            <div class = "col-lg-8" id = "col2">
                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left: -5px;">
                        <h4 id = "heading" style = "padding-left: 5px !important;"> SEARCH RESULT</h4>
                        <h4> <?php echo "<h5 style = 'color: white;'>" . strtoupper($search) . " ($searchresulttotal Wallpapers Found)</h5>"; ?></h4><br />
                    </div>
                    <?php 
                        try{
                            //Getting the total searches found
                            // $total = '';
                            // $num = array();
                            // $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat FROM details AS d, resolutions AS r, tagdetails AS td, catlink AS cl, category AS c, subcatlink AS sl, subcategory s
                            // WHERE r.d_id = d.d_id AND r.original != 'original' AND td.d_id = d.d_id
                            // AND r.width = '1920' AND r.height = '1080' AND cl.d_id = d.d_id AND cl.cat_id = c.cat_id
                            // AND sl.d_id = d.d_id AND s.sub_id = sl.sub_id
                            // AND (d.tag LIKE '%$search%' OR td.tagname = '$search' OR cat_name LIKE '%$search%' OR s.sub_name LIKE '%$search%')
                            // ORDER BY d.createdat DESC";
                            // $result1 = $pdo->query($sql1);
                            // while($row1 = $result1->fetch()){
                            //     if($row1['width'] == 1920 && $row1['height'] == 1080){
                            //         $num[] = $row1['d_id'];
                            //     }
                            // }
                            // $total = count($num);
                            // if (isset($_GET['pageno'])) {
                            // $pageno = $_GET['pageno'];
                            // } else {
                            //     $pageno = 1;
                            // }
                            // $prev = $pageno - 1;
                            // $next = $pageno + 1;
                            // $no_of_records_per_page = 1;
                            // $offset = ($pageno - 1) * $no_of_records_per_page;
                            // $pages = ceil($total/$no_of_records_per_page);
                                
                            //Displaying the search results on the screen
                            // $sql = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat FROM details AS d, resolutions AS r, tagdetails AS td, catlink AS cl, category AS c, subcatlink AS sl, subcategory s
                            // WHERE r.d_id = d.d_id AND td.d_id = d.d_id
                            // AND r.width = '1920' AND r.height = '1080' AND cl.d_id = d.d_id AND cl.cat_id = c.cat_id
                            // AND sl.d_id = d.d_id AND s.sub_id = sl.sub_id
                            // AND (d.tag LIKE '%$search%' OR td.tagname = '$search' OR cat_name LIKE '%$search%' OR s.sub_name LIKE '%$search%')
                            // ORDER BY d.createdat DESC
                            // LIMIT $offset, $no_of_records_per_page";

                            $result = $pdo->query($query);
                            while($row = $result->fetch()){
                                if($row['width'] == 1280 && $row['height'] == 720){
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
                                            $tagname = str_replace("-", "_", $tagname);

                                            echo"
                                            <div class = 'col-lg-4' style = 'margin-left: -5px;'>
                                            <a href = 'download.php?value=$tagname-$row[d_id]'>
                                                <img src = 'ssgrouplogin/$row[url]' class = 'img img-thumbnail' alt = '$alt' style = 'width: 100%; height: 100%;'>
                                                <p id = 'hidden' style = 'font-size: 16px; color: white;'><i class='fa fa-download'></i> $downloads</p><br />
                                                <h5 style = 'text-align: center; color: white;'>$row[tag]</h5>
                                                <br /><br /><br />
                                            </a>
                                            </div>";
                                        //}
                                    }
                                }
                            }
                        }catch(PDOException $e){
                            echo "An error occured ". $e;
                        }
                    ?>
                    <div class = "col-lg-12" id = "#_">
                    <div class = "container" id = "pages">
                        <?php if ($pages == 1 && !($pages > 1)){ ?>
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

                        <?php if ($pages > 1 && $pageno < $pages){ ?>
                            <br />
                            <ul class = "pagination"> 
                            <?php if ($pageno == 1){ ?>          
                                <li><a href = "#_" class = "btn btn-primary" style = "color: white;">First</a>
                            <?php } ?>

                            <?php if ($pageno > 1){ ?>          
                                <li><a href = "?search=<?php echo $search; ?>&pageno=<?php echo $pageno - 1; ?>" class = "btn btn-primary"><<< </a>
                            <?php } ?>
                            <li><a href = "?search=<?php echo $search; ?>&pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno ?></a></li>
                            <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p></li>
                            <li><a href = "?search=<?php echo $search; ?>&pageno=<?php echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages ?></a></li>
                            <li><a href = "?search=<?php echo $search; ?>&pageno=<?php echo $pageno + 1; ?>" class = 'btn btn-primary' style = 'margin-left: 20px;'>>>> </a></li>
                            </ul>
                        <?php } ?>

                        <?php if ($pageno == $pages && $pages != 1){ ?>
                            <br />
                            <ul class = "pagination">           
                                <li><a href = "?search=<?php echo $search; ?>&pageno=<?php echo $pageno - 1; ?>" class = "btn btn-primary"> <<< </a>
                                <li><a href = "?search=<?php echo $search; ?>&pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno ?></a></li>
                                <li style = "color: black !important;"><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p></li>
                                <li><a href = "?search=<?php echo $search; ?>&pageno=<?php echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages ?></a></li>
                                <li><a href = "#_" class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a></li>
                            </ul>
                        <?php } ?>

                        <?php if ($pages == 0 || $pages < 0){ ?>
                            <br />
                            <?php } ?>
                        </div>
                        </div>
                </div><br /><br />

                <!-- Space for Ads -->
                <div id = "ad">
                    <p>Advertisement</p>
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
                <!-- End of space for Ads -->
                
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