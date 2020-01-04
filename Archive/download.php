<?php 
include ('database/connection.php');
session_start();
error_reporting(0);
$id = $_GET['id'];
$authorlink = '';
$author = '';
$number = array();
$downloads = '';

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
    $id = $_GET['id'];
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download All Wallpapers</title>
    <link rel="shortcut icon" href = "icons/ico.ico">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src = "assets/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="assets/css/global.css" rel="stylesheet">
    <link href="assets/css/stylesheet.css" rel="stylesheet">
    <link href="assets/css/responsiveness.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
 
    #share-buttons img {
    width: 35px;
    padding: 5px;
    border: 0;
    box-shadow: 0;
    display: inline;
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
        <?php include ('navbar.php'); ?>

        <div id = "ads">
            <p>Advertisement</p>
        </div>
    </div><br />

    <div class = "row" id = "row">
        <?php include ('sidebar1.php'); ?>
            <div class = "col-lg-8" id = "col2">
                <div class = "row">
                    <?php
                        $id = $_GET['id'];
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

                                if($category != '' && $subcategory != ''){
                                    echo"
                                    <div class = 'col-lg-12'>
                                        <div class = 'col-lg-12' id = 'addedonheader'>
                                            <h4><a href = 'searchresults.php?search=$category' style = 'color:white'> $category </a>  >  $subcategory</h4>
                                        </div></div>
                                    <br />

                                    <div class = 'col-lg-12' id = 'imagedownload'>
                                        <a href = 'ssgrouplogin/$row[url]' download = '$row[name]' class = 'down' style = 'width: 95%;'>
                                            <img src = 'ssgrouplogin/$row[url]' class = 'img-thumbnail' style = 'width: 100%; height: 100%;' title = '$row[tag]'><br /><br />
                                        </a>
                                    </div>";
                                }

                                if($category != '' && $subcategory == ''){
                                    echo"
                                    <div class = 'col-lg-12'>
                                        <div class = 'col-lg-12' id = 'addedonheader'>
                                            <h4><a href = 'searchresults.php?search=$category' style = 'color:white'> $category </a></h4>
                                        </div></div>
                                    <br />

                                    <div class = 'col-lg-12' id = 'imagedownload'>
                                        <a href = 'ssgrouplogin/$row[url]' download = '$row[name]' class = 'down' style = 'width: 95%;'>
                                            <img src = 'ssgrouplogin/$row[url]' class = 'img-thumbnail' style = 'width: 100%; height: 100%;' title = '$row[tag]'><br /><br />
                                        </a>
                                    </div>";
                                }

                                if($category == '' && $subcategory != ''){
                                    echo"
                                    <div class = 'col-lg-12'>
                                        <div class = 'col-lg-12' id = 'addedonheader'>
                                            <h4>$subcategory</h4>
                                        </div></div>
                                    <br />

                                    <div class = 'col-lg-12' id = 'imagedownload'>
                                        <a href = 'ssgrouplogin/$row[url]' download = '$row[name]' class = 'down' style = 'width: 95%;'>
                                            <img src = 'ssgrouplogin/$row[url]' class = 'img-thumbnail' style = 'width: 100%; height: 100%;' title = '$row[tag]'><br /><br />
                                        </a>
                                    </div>";
                                }

                                if($category == '' && $subcategory == ''){
                                    echo"
                                    <div class = 'col-lg-12'>
                                        <div class = 'col-lg-12' id = 'addedonheader'>
                                            <h4>$row[tag]</h4>
                                        </div></div>
                                    <br />

                                    <div class = 'col-lg-12' id = 'imagedownload'>
                                        <a href = 'ssgrouplogin/$row[url]' download = '$row[name]' class = 'down' style = 'width: 95%;'>
                                            <img src = 'ssgrouplogin/$row[url]' class = 'img-thumbnail' style = 'width: 100%; height: 100%;' title = '$row[tag]'><br /><br />
                                        </a>
                                    </div>";
                                }
                            }
                        }catch(PDOException $e){
                            echo "An error occured ". $e;
                        }
                    ?>
                    <!-- Beginning of Code for the Facebook Share button -->
                    <div class = "col-lg-12" style = 'margin-left: 40%'>
                        <div id="share-buttons">
                            <a href="http://www.facebook.com/sharer.php?u=https://www.downloadallwallpapers.com/download.php?id=<?php echo $id ?>" target="_blank">
                                <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" style = 'width: 80%;'/>
                            </a>
                            
                            <!-- Pinterest -->
                            <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                                <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" style = 'width: 80%;'/>
                            </a>
                            
                            <!-- Twitter -->
                            <a href="https://twitter.com/share?url=https://www.downloadallwallpapers.com/download.php?id=<?php echo $id ?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=Wallpapers" target="_blank">
                                <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" style = 'width: 80%;'/>
                            </a>
                        </div>
                    </div>
                    <!-- End of Code for the facebook Share Button -->

                    <div class = "col-lg-12">
                        <h5 style = "margin-left: 6.5%; color: white;">Name: <?php echo $name; ?></h5>
                    </div>

                    <div class = "col-lg-12">
                        <?php if($downloads == ''){
                            $downloads = 0;
                        } ?>
                        <h5 style = "margin-left: 6.5%; color: white;">Downloads: <?php echo $downloads; ?></h5>
                    </div>

                    <div class = "col-lg-12">
                        <h5 style = "margin-left: 6.5%; color: white;">Added on: <?php echo $addedon; ?></h5>
                    </div>

                    <div class = "col-lg-12">
                        <h5 style = "margin-left: 6.5%; color: white;">Category: 
                            <?php 
                                for($i=0; $i < count($multicat); $i++){
                                    echo $multicat[$i] ."&nbsp&nbsp&nbsp&nbsp&nbsp";
                                }
                            ?>  
                        </h5>
                    </div>

                    <div class = "col-lg-12">
                        <h5 style = "margin-left: 6.5%; color: white;">Description: <?php echo $description; ?></h5>
                    </div>

                    <!-- Beginning Wallpaper Tags -->
                    <div class = "col-lg-12" style = "margin-left: 6.5%;">
                        <div class = "row" style = "margin-left: -7.2%;">
							<h5 style = "margin-left: 6.5%; color: white;">Tags:</h5>
                            <?php 
                                $tags = array();
                                $count = '';

                                try{
                                    $sql = "SELECT * FROM tagdetails WHERE d_id = '$id' LIMIT 5";
                                    $result = $pdo->query($sql);
                                    while($row = $result->fetch()){
                                        echo"
                                            <a href = 'searchresults.php?search=$row[tagname]'
                                            style = 'margin-left: 7.2%; height: 40px; margin-top: 5px; font-size: 16px; font-weight: bold; background-color: rgb(75, 74, 74);'>
                                                $row[tagname]
                                            </a><br /><br />";
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
                                if($authorlink != '' && $author != '') echo "<a href = '$authorlink' target = '_black' class = 'btn btn-primary' 
                                style = 'background-color: rgb(73, 133, 204); border: 2px solid rgb(73, 133, 204);'>$author</a>"; 
                                if($authorlink == '') echo "<a href = '#'>$author</a>"; 
                                echo "</h5>";
                            ?>
                    </div>

                    <div class = "col-lg-12">
                        <div id = "resolutions">
                            <br />
                            <div class = "row">
                                <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <p style = "margin-left: 3%; text-align: center;"><i class="fa fa-download"></i>Download this wallpaper from the following resolutions</p>
                                </div>
                            </div>
                            <?php
                                echo"
                                <div class = 'col-lg-12'>
                                <h5 style = 'margin-left: 3%; color: white; text-align: center;'>";
                                $id = $_GET['id'];
                                try{
                                    $sql = "SELECT * FROM details AS d, resolutions AS r
                                    WHERE d.d_id = '$id'
                                    AND r.d_id = d.d_id AND r.width = '1280' AND r.height = '720'";

                                    $result = $pdo->query($sql);
                                    while($row = $result->fetch()){
                                        echo"
                                        <a href = 'ssgrouplogin/$row[url]' download = '$row[name]' class = 'down'>1280 x 720 (HD)</a> <br /><br />";
                                    }

                                    $sql1 = "SELECT * FROM details AS d, resolutions AS r
                                    WHERE d.d_id = '$id'
                                    AND r.d_id = d.d_id AND r.width = '1920' AND r.height = '1080'";
                                    $result1 = $pdo->query($sql1);
                                    while($row1 = $result1->fetch()){
                                        echo"
                                        <a href = 'ssgrouplogin/$row1[url]' download = '$row1[name]' class = 'down'>1920 x 1080 (FHD)</a> <br /><br />";
                                    }

                                    $sql2 = "SELECT * FROM details AS d, resolutions AS r
                                    WHERE d.d_id = '$id'
                                    AND r.d_id = d.d_id AND r.width = '2560' AND r.height = '1440'";
                                    $result2 = $pdo->query($sql2);
                                    while($row2 = $result2->fetch()){
                                        echo"
                                        <a href = 'ssgrouplogin/$row2[url]' download = '$row2[name]' class = 'down'>2560 x 1440 (QHD)</a> <br /><br />";
                                    }

                                    $sql3 = "SELECT * FROM details AS d, resolutions AS r
                                    WHERE d.d_id = '$id'
                                    AND r.d_id = d.d_id AND r.width = '3840' AND r.height = '2160'";
                                    $result3 = $pdo->query($sql3);
                                    while($row3 = $result3->fetch()){
                                        echo"
                                        <a href = 'ssgrouplogin/$row3[url]' download = '$row3[name]' class = 'down'>3840 x 2160 (4K)</a> <br /><br />";
                                    }

                                    $sql4 = "SELECT * FROM details AS d, resolutions AS r
                                    WHERE d.d_id = '$id'
                                    AND r.d_id = d.d_id AND r.width = '5120' AND r.height = '2880'";
                                    $result4 = $pdo->query($sql4);
                                    while($row4 = $result4->fetch()){
                                        echo"
                                        <a href = 'ssgrouplogin/$row4[url]' download = '$row4[name]' class = 'down'>5120 x 2880 (5K)</a> <br /><br />";
                                    }
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
                        </div><br />

                        <div class = "row" style = "width: 93%; margin-left: 4%;">
                            <div class = "col-lg-12">
                                <h4 style = "color: white;">Related Wallpaper</h4>
                            </div>
                            <?php 
                                try{
                                    $sql = "SELECT * FROM details AS d, resolutions AS r, category AS c, catlink AS cl
                                    WHERE c.cat_name = '$category' AND d.d_id != '$id' AND cl.d_id = d.d_id AND c.cat_id = cl.cat_id
                                    AND r.d_id = d.d_id AND r.width = '1920' AND r.height = '1080' 
                                    ORDER BY RAND() LIMIT 3";
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
                                                echo"
                                                <div class = 'col-lg-4' style = 'margin-left: -5px;'>
                                                <a href = 'download.php?id=$row[d_id]'>
                                                    <img src = 'ssgrouplogin/$row[url]' class = 'img img-thumbnail' style = 'width: 100%; height: 100%;'>
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