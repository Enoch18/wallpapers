<?php
include ('session.php');
include ('inc.php');
include ('../database/connection.php');

$catname = '';
$catid = $_POST['catid'][0];
    try{
        $sql = "SELECT * FROM category WHERE cat_id = $catid";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()){
            $catname = $row['cat_name'];
        }
    }catch(PDOException $e){
        echo "An error just occured ".$e;
        $status = "failed";
    }

function resize_image($file, $max_resolution, $width, $height){
    if(file_exists($file)){
        $original_image = imagecreatefromjpeg($file);
        //resolution
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);
        
        //check the width knowing the ratio of reduction
        $ratio = $max_resolution/$original_width;
        $new_width = $width;
        $new_height = $height;
        $orig = " ";
        if ($original_width == $width && $original_height == $height){
            $orig = "original";
        }
        
        if($new_height >$max_resolution){
            $ratio = $max_resolution/$original_height;
            $new_height = $max_resolution;
            $new_width = $original_width * $ratio;
        }

        $catname = '';
        $catid = $_POST['catid'][0];
        try{
            include ('../database/connection.php');

            $sql = "SELECT * FROM category WHERE cat_id = $catid";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()){
                $catname = $row['cat_name'];
            }
        }catch(PDOException $e){
            echo "An error just occured ".$e;
            $status = "failed";
        }

        if ($catname == ''){
            $catname = 'others';
        }

        $path = "images/" . date("Y") . "/" . date("M") . "/" . date('d');
        if (!is_dir($path)){
            mkdir($path, 0777, true);
        }

        $fileext = $ext = pathinfo($file, PATHINFO_EXTENSION);
        $path_parts = pathinfo($file);
        $filename = $path_parts['filename'];
        $file = str_replace(" ", "", $filename) . '_' . $width . '_X_' . $height . '.' . $fileext;
        $file = $path . "/" . $file;
        
        if($original_image){
            // Beginning of code for inserting the resolutions
            $number = array();
            $did = '';
            $createdat = date('Y-m-d H:i:s');
            try{
            //beginning of code for getting the details id of the image
                include ('../database/connection.php');
                $sql1 = "SELECT * FROM details";
                $result = $pdo->query($sql1);
                while ($row = $result->fetch()){
                    $number[] = $row['d_id'];
                }
                $did = max($number);
            //End of code for getting the details id of the image

            //Beginning of code for storing the url of various resolutions of the image
            $sql = "INSERT INTO resolutions SET
            d_id = :did,
            width = :width,
            height = :height,
            original = :orig,
            url = :url,
            createdat = :createdat
            ";
            $s = $pdo->prepare($sql);
            $s->bindValue(':did', $did);
            $s->bindValue(':width', $width);
            $s->bindValue(':height', $height);
            $s->bindValue(':orig', $orig);
            $s->bindValue(':url', $file);
            $s->bindValue(':createdat', $createdat);
            $s->execute();
            //End of code for storing the url of various resolutions of the image

            }catch(PDOException $e){
                echo "Could not perform the operation ".$e;
                $status = "failed";
            }

            // End of code for inserting the resolutions       
            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_image, $original_image, 0,0,0,0, $new_width, $new_height, $original_width, $original_height);
            imagejpeg($new_image, $file, 100);
        }
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_FILES['image']) && $_FILES['image']['type'] == 'image/jpeg'){
        move_uploaded_file($_FILES['image']['tmp_name'], $_FILES['image']['name']);
        $file = $_FILES['image']['name'];
        // Beginning of Code for Inserting the details of the image in the details' table

        $original_image = imagecreatefromjpeg($file);
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);
        $width = $original_width;
        $height = $original_height;
        $max_resolution = $width;
        if($height > $width){
            $max_resolution = $height;
        }

        try{
            $date = $_POST['date'];
            $time = $_POST['time'] . ":00";
            $liveat = $date . " ". $time;
            $liveat = date('Y-m-d H:i:s', strtotime($liveat. ' - 6 hours 30 minutes'));
            $tag = $_POST['tag'];
            $author = $_POST['author'];
            if($_POST['authorlink'] != '')
            $authorlink = $_POST['authorlink'];
            if($_POST['authorlink'] == '')
            $authorlink = "";
            $description = $_POST['imagedescription'];
            $createdat = date('Y-m-d H:i:s');

            $sql = "INSERT INTO details SET
            tag = :tag,
            author = :author,
            link = :authorlink,
            description = :description,
            name = :name,
            createdat = :createdat,
            liveat = :liveat
            ";
            $s = $pdo->prepare($sql);
            $s->bindValue(':tag', $tag);
            $s->bindValue(':author', $author);
            $s->bindValue(':authorlink', $authorlink);
            $s->bindValue(':name', $file);
            $s->bindValue(':description', $description);
            $s->bindValue(':createdat', $createdat);
            $s->bindValue(':liveat', $liveat);
            $s->execute();

            $num = array();
            $sql2 = "SELECT * FROM details";  
            $result2 = $pdo->query($sql2);
            while($row2 = $result2->fetch()){
                $num[] = $row2['d_id'];
            }

            $did = max($num);
            $tag2 = $_POST['tag2'];
            $tagname = explode(",", $tag2);
            $total = count($tagname);
            for($i=0; $i<$total; $i++){
                $created_at = date("Y-m-s H:i:s");
                $sql3 = "INSERT INTO tagdetails SET
                tagname = :tagname,
                alt = :alt,
                d_id = :did,
                created_at = :created_at";
                $s3 = $pdo->prepare($sql3);
                $s3->bindValue(':tagname', str_replace(" ", "", $tagname[$i]));
                $s3->bindValue(':did', $did);
                $s3->bindValue(':alt', '');
                $s3->bindValue(':created_at', $created_at);
                $s3->execute();
            }

            $did = max($num);
            $tag2 = $_POST['alttags'];
            $tagname = explode(",", $tag2);
            $total = count($tagname);
            for($i=0; $i<$total; $i++){
                $created_at = date("Y-m-s H:i:s");
                $sql3 = "INSERT INTO tagdetails SET
                tagname = :tagname,
                alt = :alt,
                d_id = :did,
                created_at = :created_at";
                $s3 = $pdo->prepare($sql3);
                $s3->bindValue(':tagname', str_replace(" ", "", $tagname[$i]));
                $s3->bindValue(':did', $did);
                $s3->bindValue(':alt', '');
                $s3->bindValue(':created_at', $created_at);
                $s3->execute();
            }

            //Code for populating the Category and the subcategory 
            $did = '';
            $num = array();
            $sql1 = "SELECT * FROM details";  
            $result = $pdo->query($sql1);
            while($row = $result->fetch()){
                $num[] = $row['d_id'];
            }

            $did = max($num);
            $catidtotal = count($_POST['catid']);
            $subidtotal = count($_POST['subid']);

            if ($catidtotal != 0){
                for ($i=0; $i<$catidtotal; $i++){
                    $sql1 = "INSERT INTO catlink SET
                    d_id = :did,
                    cat_id = :catid";
                    $s = $pdo->prepare($sql1);
                    $s->bindValue(':did', $did);
                    $s->bindValue(':catid', $_POST['catid'][$i]);
                    $s->execute();
                }
            }

            if ($subidtotal != 0){
                for ($i=0; $i<$subidtotal; $i++){
                    $sql1 = "INSERT INTO subcatlink SET
                    d_id = :did,
                    sub_id = :subid";
                    $s = $pdo->prepare($sql1);
                    $s->bindValue(':did', $did);
                    $s->bindValue(':subid', $_POST['subid'][$i]);
                    $s->execute();
                }
            }
            //End of Code for populating the Category and the subcategory

            $result = $tag . " uploaded successfully!!!";
        }catch(PDOException $e){
            $failed = "Failed to add the image!!!" . $e;
        }

        // Beginning of Code for Inserting the details of the image in the details' table

        // Call to the image resizing Function
        resize_image($file, "500", "500", "281");
        resize_image($file, "1280", "1280", "720");
        resize_image($file, "1920", "1920", "1080");
        resize_image($file, "2560", "2560", "1440");
        resize_image($file, "3840", "3840", "2160");
        resize_image($file, "5120", "5120", "2880");
        //resize_image($file, "7680", "7680", "4320");

        // End of Call to the image resizing Function
        unlink($file);
    }
}
?>