<?php 
if(isset($_POST['searchsubmit']) && $_POST['search'] != ''){
    $search = $_POST['search'];
    header("Location: viewwallpapers.php?search=$search");
}

error_reporting(0);
include ('session.php');
include ('../database/connection.php');
include ('../database/createtables.php');
include ('inc.php');

$search = '';
if ($_GET['search'] != ''){
    $search = $_GET['search'];
}

if ($_GET['category'] != ''){
    $search = $_GET['category'];
}

$id = $_GET['id'];
$catname = $_GET['catname'];


if($id != ''){
    try{
        $sql3 = "SELECT * FROM resolutions WHERE d_id = '$id'";
        $result = $pdo->query($sql3);
        while($row = $result->fetch()){
            unlink($row['url']);
        }

        $sql = "DELETE FROM details WHERE d_id = '$id'";
        $pdo->exec($sql);

        $sql2 = "DELETE FROM resolutions WHERE d_id = '$id'";
        $pdo->exec($sql2);

        $sql6 = "DELETE FROM downloads WHERE d_id = '$id'";
        $pdo->exec($sql6);

        $sql7 = "DELETE FROM catlink WHERE d_id = '$id'";
        $pdo->exec($sql7);

        $sql8 = "DELETE FROM subcatlink WHERE d_id = '$id'";
        $pdo->exec($sql8);

        $sql9 = "DELETE FROM tagdetails WHERE d_id = '$id'";
        $pdo->exec($sql9);
        
    }catch(PDOException $e){
        echo "Error: " . $e;
    }
}

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
    WHERE r.d_id = d.d_id AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 500 && $row1['height'] == 281){
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
        WHERE r.d_id = d.d_id AND r.width = '500' AND r.height = '281'
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
    WHERE r.d_id = d.d_id AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 500 && $row1['height'] == 281){
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
        WHERE r.d_id = d.d_id AND r.width = '500' AND r.height = '281'
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
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 500 && $row1['height'] == 281){
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
        AND r.width = '500' AND r.height = '281'
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
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 500 && $row1['height'] == 281){
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
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
}

if($subcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, subcatlink as sl, subcategory AS s
    WHERE r.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 500 && $row1['height'] == 281){
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
    AND r.width = '500' AND r.height = '281'
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
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 500 && $row1['height'] == 281){
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
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
}

if($subcount > 0 && $tagcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, tagdetails AS td, subcatlink AS sl, subcategory AS s
    WHERE r.d_id = d.d_id AND td.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%' OR s.sub_name LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 500 && $row1['height'] == 281){
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
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR td.tagname LIKE '%$search%' OR s.sub_name LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
}

if($subcount > 0 && $catcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, subcatlink AS sl, subcategory AS s, category AS c, catlink cl
    WHERE r.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id AND cl.d_id = d.d_id AND c.cat_id = cl.cat_id
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 500 && $row1['height'] == 281){
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
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%' OR c.cat_name LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
}

if($subcount > 0 && $catcount > 0 && $tagcount > 0){
    $num = array();
    $sql1 = "SELECT DISTINCT d.d_id, url, tag, width, height, liveat 
    FROM details AS d, resolutions AS r, subcatlink AS sl, subcategory AS s, category AS c, catlink cl, tagdetails AS td
    WHERE r.d_id = d.d_id AND sl.sub_id = s.sub_id AND sl.d_id = d.d_id AND cl.d_id = d.d_id AND c.cat_id = cl.cat_id AND td.d_id = d.d_id
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%' OR c.cat_name LIKE '%$search%' OR td.tagname LIKE '%$search%')
    ORDER BY d.createdat DESC";
    $result1 = $pdo->query($sql1);
    while($row1 = $result1->fetch()){
        if($row1['width'] == 500 && $row1['height'] == 281){
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
    AND r.width = '500' AND r.height = '281'
    AND (d.tag LIKE '%$search%' OR s.sub_name LIKE '%$search%' OR c.cat_name LIKE '%$search%' OR td.tagname LIKE '%$search%')
    ORDER BY d.createdat DESC
    LIMIT $offset, $no_of_records_per_page";
}
}
?>

<style>
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    margin-left: auto;
    margin-right: auto;
    }

    /* Modal Content */
    .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 500px;
    }

    /* The Close Button */
    .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
    }

    #catbtn{
        width: 100%;
    }

    #edit{
        margin-top: -120%; 
        margin-left: 20%;
    }

    .delete{
        margin-top: -120%; 
        margin-left: -60%;
    }

    #details{
        margin-top: -120%; 
        margin-left: -143%;
        margin-left: 0px;
    }

    @media (max-width: 1400px){
        #edit{
        margin-top: -160%; 
        margin-left: 10%;
        }

        .delete{
            margin-top: -160%; 
            margin-left: -30%;
        }

        #details{
            margin-top: -160%; 
            margin-left: -50%;
        }
    }

    @media (max-width: 979px){
        #edit{
        margin-top: -40%; 
        margin-left: 10%;
        }

        .delete{
            margin-top: -47.5%; 
            margin-left: 25%;
        }

        #details{
            margin-top: -55%; 
            margin-left: 40%;
        }

        #searchbtn{
            margin-top: 10px !important;
        }
    }

    @media (max-width: 767px){
        #edit{
        margin-top: -37.5%; 
        margin-left: 10%;
        }

        .delete{
            margin-top: -50%; 
            margin-left: 25%;
        }

        #details{
            margin-top: -62.5%; 
            margin-left: 40%;
        }

        #searchbtn{
            margin-top: 10px !important;
        }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>   
    </nav>
    <div class="container-fluid">
        <div class = "row">
        <!-- <div class = "col-lg-12">
            <h4>Categories</h4>
        </div> -->
        <?php
            // try{
            //     $sql = "SELECT * FROM category";
            //     $result = $pdo->query($sql);
            //     while($row = $result->fetch()){
            //         echo "
            //         <div class = 'col-lg-2'>
            //             <a href = '?catname=$row[cat_name]' class = 'btn btn-primary' id = 'catbtn'> $row[cat_name] </a>
            //         </div><br /><br />
            //         ";
            //     } 
            // }catch(PDOException $e){
            //     echo "An error occured. " .$e;
            // }
        ?>
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class = "modal-header">
                    <h4 class = "modal-title" style = "color: black !important;">Confirm Delete</h4>
                    <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                </div>
            
                <h5 style = "color: black !important;">Are you sure you want to delete?</h5><br />
                <div>
                    <span id = "yes"></span>
                    <button type = "button" class = "btn btn-primary" class = "close" id = "no" style = "width: 30%; margin: 20px;">No</a> 
                </div>
            </div>
        </div>


        <div class = "col-lg-12">
            <form action = "" method = "POST" class = "form-group">
                <div class = "row">
                    <input type = "search" name = 'search' placeholder = "search" class = "col-lg-7" id = "search"><br /><br />
                    <button type = "submit" name = "searchsubmit" value = "submit" class = "btn btn-primary" id = "searchbtn">
                    <i class="fa fa-search" style = "margin-top: -10px; margin-right: 10px; font-size: 25px;"></i></button><br /><br />
                    <div id = "list" style = "position: absolute; margin-top: 45px; width: 200px; background-color: white; z-index: 1000;"></div>
                </div>
            </form>
        </div>

        <div class = "row" id = "#_">
            <?php
                // Beginning of code if no category is selected
                if($catname == '' && $search == ''){
                    echo"
                    <div class = 'col-lg-12' style = 'margin-left: -5px;'>
                        <h4> All Wallpapers</h4>
                    </div>";
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
                        AND r.width = '500' AND r.height = '281'  ORDER BY d.createdat DESC LIMIT $offset, $no_of_records_per_page";
                        $result = $pdo->query($sql);
                        while($row = $result->fetch()){
                            $tagname = str_replace(' ', '_', $row['tag']);
                            $tagname = str_replace("-", "_", $tagname);
                            echo"
                            <div class = 'col-lg-4' style = 'margin-left: -5px; margin-top: 2%;'>
                                <img src = '$row[url]' class = 'img-thumbnail' style = 'width: 100%; height: 100%;'>
                                <div class = 'row'>
                                    <div class = 'col-md- 3 col-lg-4'>
                                        <a href = 'editwallpaper.php?value=$tagname-$row[d_id]' class = 'btn btn-primary' id = 'edit'><i class='fa fa-edit'></i></a>
                                    </div>

                                    <div class = 'col-md- 3 col-lg-4'>
                                        <a class = 'btn btn-danger delete' id = '$row[d_id]'><i class='fa fa-trash-o'></i></a>
                                    </div>

                                    <div class = 'col-md- 3 col-lg-4'>
                                        <a href = 'wallpaperdetails.php?value=$tagname-$row[d_id]' class = 'btn btn-info' id = 'details'><i class='fa fa-eye'></i></a>
                                    </div>
                                </div>
                            </div>";
                        }

                        
                        echo"
                        <div class = 'col-lg-12'>
                        <div class = 'container' id = 'pages'>";
                        if ($pageno == 1 && $pages > 0){
                            $pos = $pageno + 1;
                            $neg = $pageno - 1;
                            echo"
                            <br />
                            <ul class = 'pagination'>           
                                <li><a href = '#_' class = 'btn btn-primary'>First</a>
                                <li><a href = '?pageno=$pageno' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pageno</a>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>Out of</p>
                                <li><a href = '?pageno=$pages' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pages</a><li>
                                <li>";
                                if($pages == 1){
                                echo "
                                <a href = '#_' class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a>
                                </ul>";
                                }
                                if($pages > 1){
                                    echo "
                                    <a href = '?pageno=$pos' class = 'btn btn-primary' style = 'margin-left: 20px;'> >>> </a>
                                    </ul>";
                                }
                        }

                        if ($pageno >= 2 && $pageno != $pages){
                            $pos = $pageno + 1;
                            $neg = $pageno - 1;
                            echo"
                            <br />
                            <ul class = 'pagination'>           
                                <li><a href = '?pageno=$neg' class = 'btn btn-primary'> <<< </a>
                                <li><a href = '?pageno=$pageno' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pageno</a>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>Of</p>
                                <li><a href = '?pageno=$pages' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pages</a><li>
                                <li>";
                                
                                echo "<a href = '?pageno=$pos' class = 'btn btn-primary' style = 'margin-left: 20px;'> >>> </a>
                                </li>
                            </ul>";
                        }

                        if ($pageno == $pages && $pages != 1){
                            $neg = $pageno - 1;
                            echo"
                            <br />
                            <ul class = 'pagination'>           
                                <li><a href = '?pageno=$neg' class = 'btn btn-primary'> <<< </a>
                                <li><a href = '?pageno=$pageno' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pageno</a>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>Out of</p>
                                <li><a href = '?pageno=$pages' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pages</a><li>
                                <li><a href = '#_' class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a>
                            </ul>";
                        }
                        echo"</div>
                    </div>";
                    }catch(PDOException $e){
                        echo "An error occured ". $e;
                    }
                }
                
                if($search != ''){
                    $searchname = ucwords($search);
                    try{
                        if ($_GET['search']){
                            echo "
                            <div class = 'col-lg-12' style = 'margin-left: -5px;'>
                                <h4> Search Result Wallpapers</h4>
                            </div>
                            <div class = 'col-lg-12'>
                                <a href = 'viewwallpapers.php' class = 'btn btn-primary'>Back To All</a><br />
                                <h4>$searchname ($total Wallpapers Found)</h4>
                            </div>
                            ";  
                        }

                        if ($_GET['category']){
                            echo "
                            <div class = 'col-lg-12'>
                                <a href = 'viewwallpapers.php' class = 'btn btn-primary'>Back To All</a><br />
                                <h3>$searchname</h3>
                            </div>
                            ";  
                        }

                        $result = $pdo->query($query);
                        while($row = $result->fetch()){
                            if($row['width'] == 500 && $row['height'] == 281){
                                $tagname = str_replace(' ', '_', $row['tag']);
                                $tagname = str_replace("-", "_", $tagname);
                                echo"
                                <div class = 'col-lg-4' style = 'margin-left: -5px;'>
                                    <img src = '$row[url]' class = 'img-thumbnail' style = 'width: 100%; height: 100%;'>
                                    <div class = 'row'>
                                        <div class = 'col-md- 3 col-lg-4'>
                                            <a href = 'editwallpaper.php?value=$tagname-$row[d_id]' class = 'btn btn-primary' id = 'edit'><i class='fa fa-edit'></i></a>
                                        </div>
                    
                                        <div class = 'col-md- 3 col-lg-4'>
                                            <a href = '?id=$row[d_id]' class = 'btn btn-danger delete' id = '$row[d_id]'><i class='fa fa-trash-o'></i></a>
                                        </div>
                        
                                        <div class = 'col-md- 3 col-lg-4'>
                                            <a href = 'wallpaperdetails.php?value=$tagname-$row[d_id]' class = 'btn btn-info' id = 'details'><i class='fa fa-eye'></i></a>
                                        </div>
                                    </div>
                                </div>";
                            }
                        }

                        echo"
                        <div class = 'col-lg-12'>
                        <div class = 'container' id = 'pages'>";
                        if ($pageno == 1 && $pages > 0){
                            $pos = $pageno + 1;
                            $neg = $pageno - 1;
                            echo"
                            <br />
                            <ul class = 'pagination'>           
                                <li><a href = '#_' class = 'btn btn-primary'>First</a>
                                <li><a href = '?search=$search&pageno=$pageno' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pageno</a>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>Out of</p>
                                <li><a href = '?search=$search&pageno=$pages' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pages</a><li>
                                <li>";
                                if($pages == 1){
                                echo "
                                <a href = '#_' class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a>
                                </ul>";
                                }
                                if($pages > 1){
                                    echo "
                                    <a href = '?search=$search&pageno=$pos' class = 'btn btn-primary' style = 'margin-left: 20px;'> >>> </a>
                                    </ul>";
                                }
                        }

                        if ($pageno >= 2 && $pageno != $pages){
                            $pos = $pageno + 1;
                            $neg = $pageno - 1;
                            echo"
                            <br />
                            <ul class = 'pagination'>           
                                <li><a href = '?search=$search&pageno=$neg' class = 'btn btn-primary'> <<< </a>
                                <li><a href = '?search=$search&pageno=$pageno' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pageno</a>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>Of</p>
                                <li><a href = '?search=$search&pageno=$pages' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pages</a><li>
                                <li>";
                                
                                echo "<a href = '?search=$search&pageno=$pos' class = 'btn btn-primary' style = 'margin-left: 20px;'> >>> </a>
                                </li>
                            </ul>";
                        }

                        if ($pageno == $pages && $pages != 1){
                            $neg = $pageno - 1;
                            echo"
                            <br />
                            <ul class = 'pagination'>           
                                <li><a href = '?search=$search&pageno=$neg' class = 'btn btn-primary'> <<< </a>
                                <li><a href = '?search=$search&pageno=$pageno' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pageno</a>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>Out of</p>
                                <li><a href = '?search=$search&pageno=$pages' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pages</a><li>
                                <li><a href = '#_' class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a>
                            </ul>";
                        }
                        echo"</div>
                        </div>";
                    }catch(PDOException $e){
                        echo "An error occured ". $e;
                    }
                }
                //End of Code if category is selected
            ?>
        </div>
    </div>

<script>
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

// Get the modal
var modal = document.getElementById("myModal");

$(document).ready(function(){
    $(".delete").click(function(){
        let path = "?id=" + this.id;
        modal.style.display = "block";
        $("#yes").html("<a href = '"+path+"' class = 'btn btn-danger' style = 'width: 30%;'>Yes</a>");
        $("#deleteconfirm").modal('show');
    });
    
    $(".close").click(function(){
        $(".modal").css({
            display: 'none'
        });
    });

    $("#no").click(function(){
        $(".modal").css({
            display: 'none'
        });
    });
    
    $("#search").keyup(function(){
            let search = $("#search").val();
            // list
            if (search != ''){
                $.ajax({
                    url: "../predict?value=" + search,
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

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>