<?php
include ('session.php');
include ('inc.php');
include ('../database/connection.php');

$value = $_GET['value'];
$exploded = explode("-", $_GET['value']);

$id = (int)$exploded[1];

$category = array();
$subcategory = array();
$deleted = '';
if (isset($_POST['tagdelete'])){
    $tagid = $_POST['check_list'];
    $total = count($_POST['check_list']);

    for($i=0; $i < $total; $i++){
        if($_POST['check_list'][$i] != ''){
            $tid = $_POST['check_list'][$i];
            $sql = "DELETE FROM tagdetails WHERE id = '$tid'";
            $pdo->exec($sql);
            $deleted = "Tag(s) Deleted Successfully!";
        }
    }
}

if (isset($_POST['res_id'])){
    foreach ($_POST['res_id'] as $resid){
        $sql = "UPDATE resolutions SET
        active = :active
        WHERE r_id = '$resid'";
        $s = $pdo->prepare($sql);
        $s->bindValue(':active', '1');
        $s->execute();
    }   
}

$response = "";
if (isset($_POST['submitedit'])){
    if ($_POST['edittag'] != ''){
        $total = count($_POST['edittag']);
        for($i = 0; $i<$total; $i++){
            if ($_POST['edittag'][$i] != ''){
                $etagname = $_POST['edittag'][$i];
                $etagid = $_POST['tagids'][$i];
                $response = "Tag(s) Updated Successfully";

                $sql = "UPDATE tagdetails SET
                tagname = :tagname
                WHERE id = '$etagid'";
                $s = $pdo->prepare($sql);
                $s->bindValue(':tagname', $etagname);
                $s->execute();
            }
        }
    }
}

//Code for getting the category and the subcategory.
try{
    $sql = "SELECT DISTINCT cat_name FROM details AS d, category AS c, catlink AS cl WHERE d.d_id = cl.d_id AND c.cat_id = cl.cat_id AND d.d_id = '$id'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $category[] = $row['cat_name'];
    }
}catch(PDOException $e){
    echo "Error " . $e;
}

try{
    $sql = "SELECT DISTINCT sub_name FROM details AS d, subcategory AS s, subcatlink AS sl WHERE d.d_id = sl.d_id AND s.sub_id = sl.sub_id AND d.d_id = '$id'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $subcategory[] = $row['sub_name'];
    }
}catch(PDOException $e){
    echo "Error " . $e;
}

//End ofCode for getting the category and the subcategory.

$result = '';
$failed = '';
try{
    if (isset($_POST['submit'])){
        $catid = $_POST['category'];
        $subid = $_POST['subid'];
        $tag = $_POST['tag'];
        $description = $_POST['imagedescription'];
        $author = $_POST['author'];
        $authorlink = $_POST['authorlink'];

        if($tag != ''){
            $sql1 = "UPDATE details SET
                tag = :tag
                WHERE d_id = $id
            ";
            $s1 = $pdo->prepare($sql1);
            $s1->bindValue(':tag', $tag);
            $s1->execute();
        }

        if($author != ''){
            $sql1 = "UPDATE details SET
                author = :author
                WHERE d_id = $id
            ";
            $s1 = $pdo->prepare($sql1);
            $s1->bindValue(':author', $author);
            $s1->execute();
        }

        if($authorlink != ''){
            $sql1 = "UPDATE details SET
                link = :link
                WHERE d_id = $id
            ";
            $s1 = $pdo->prepare($sql1);
            $s1->bindValue(':link', $authorlink);
            $s1->execute();
        }

        if($description != ''){
            $sql2 = "UPDATE details SET
                description = :description
                WHERE d_id = $id
            ";
            $s2 = $pdo->prepare($sql2);
            $s2->bindValue(':description', $description);
            $s2->execute();
        }

        if($_POST['tag2'] != ''){
            $tag2 = $_POST['tag2'];
            $tagname = explode(",", $tag2);
            $total = count($tagname);
            for($i=0; $i<$total; $i++){
                $sql3 = "INSERT INTO tagdetails SET
                tagname = :tagname,
                d_id = :did";
                $s3 = $pdo->prepare($sql3);
                $s3->bindValue(':tagname', $tagname[$i]);
                $s3->bindValue(':did', $id);
                $s3->execute();
            }
        }

        //Code for populating the Category and the subcategory
        $catidtotal = count($_POST['catid']);
        $subidtotal = count($_POST['subid']);

        if ($catidtotal > 0){
            if(count($category) > 0){
                $sql = "DELETE FROM catlink WHERE d_id = '$id'";
                $pdo->exec($sql);
            }
            for ($i=0; $i<$catidtotal; $i++){
                $sql1 = "INSERT INTO catlink SET
                d_id = :did,
                cat_id = :catid";
                $s = $pdo->prepare($sql1);
                $s->bindValue(':did', $id);
                $s->bindValue(':catid', $_POST['catid'][$i]);
                $s->execute();
            }
        }

        if ($subidtotal > 0){
            if(count($subcategory) > 0){
                $sql = "DELETE FROM subcatlink WHERE d_id = '$id'";
                $pdo->exec($sql);
            }
            for ($i=0; $i<$subidtotal; $i++){
                $sql1 = "INSERT INTO subcatlink SET
                d_id = :did,
                sub_id = :subid";
                $s = $pdo->prepare($sql1);
                $s->bindValue(':did', $id);
                $s->bindValue(':subid', $_POST['subid'][$i]);
                $s->execute();
            }
        }
        //End of Code for populating the Category and the subcategory
        $result = "Wallpaper successfully updated";
    }
}catch(PDOException $e){
   echo "An Error occured " . $e;
    $failed = "An error occured while trying to Modify image.";
}
$downloads = '';
$did = $id;
try{
$sqld = "SELECT counter FROM downloads WHERE d_id = '$did'";
$resultd = $pdo->query($sqld);
$number = array();
while ($rowd = $resultd->fetch()){
    $downloads = $rowd['counter'];
}
}catch(PDOException $e){
    echo $e;
}
if($downloads >= 1000){
    $downloads = $downloads/1000;
    $downloads = number_format($downloads, 1) . "k";
}

if($downloads >= 1000000){
    $downloads = $downloads/1000000;
    $downloads = number_format($downloads, 1) . "M";
}
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>

    <!-- Beginning of code for the Add image form -->
        <form action = "" method = "post" enctype = "multipart/form-data">
                <h4 style = "margin-top: 10%; margin-left: 20px;">MODIFY DETAILS</h4>
                <?php 
                    if($result != '')echo "<p style = 'background-color:green; font-weight: bold; color: white; text-align:center;'>$result</p>"; 
                    if($result == '')echo "<p style = 'background-color:red; font-weight: bold; color: white; text-align:center;'>$failed</p>"; 

                    if($response != ''){
                        echo "<p style = 'color: green; font-weight:bold; margin-left: 2px; text-align:center;'>$response</p>";
                    }

                    if($deleted != ''){
                        echo "<p style = 'color: green; font-weight:bold; margin-left: 2px; text-align:center;'>$deleted</p>";
                    }
                ?>

            <div class = "row" style = "margin-right: 10px;">
                <div class = "col-lg-6">
                    <?php
                    $id = $id;
                    try{
                        $sql = "SELECT * FROM details AS d, resolutions AS r
                        WHERE d.d_id = '$id' AND r.d_id = d.d_id
                        AND r.width = '1920' AND r.height = '1080'";
                        $result = $pdo->query($sql);
                        while($row = $result->fetch()){
                            echo"
                            <div class = 'col-lg-12' id = 'imagedownload' style = 'text-align: center;'>
                                <img src = '$row[url]' class = 'img-thumbnail' style = 'width: 90%; height: 90%;' title = '$row[tag]'><br />
                                <h6 style = 'font-weight: bold'>Image title/Name:</h6> <p>$row[tag]</p>

                                <h6 style = 'font-weight: bold'>Category:</h6>
                                ";
                                $cattotal = count($category);
                                $ccount = 0;
                                $inc = -1;
                                for($i=0; $i<$cattotal; $i++){
                                    $inc ++;
                                    $ccount++;
                                    echo "<p> $ccount) " . $category[$inc] ."</p>";
                                }

                                echo "<h6 style = 'font-weight: bold'>Subcategory: </h6>";
                                $subtotal = count($subcategory);
                                $ccount = 0;
                                $inc = -1;
                                for($i=0; $i<$subtotal; $i++){
                                    $inc ++;
                                    $ccount++;
                                    echo "<p> $ccount) " . $subcategory[$inc] ."</p>";
                                }
                                $id = $row['d_id'];
                                $server = $_SERVER['SERVER_NAME'];
                                if ($_SERVER['SERVER_NAME'] == 'localhost'){
                                    $server = "http://" . $_SERVER['SERVER_NAME'] . "/wallpapers";
                                }else{
                                    "http://" . $_SERVER['SERVER_NAME'];
                                }

                                echo "
                                <h6 style = 'font-weight: bold'>Added on:</h6><p>$row[createdat]</p>
                                <h6 style = 'font-weight: bold'>Downloads:</h6><p>$downloads</p>
                                
                                
                                <h6 style = 'font-weight: bold'>Description:</h6> <p>$row[description]</p><br />
                                <h6 style = 'font-weight: bold'>Url:</h6>
                                <a href = '$server/download.php?value=$value' target = '_blank' style = 'margin-top: -20%;'>
                                $server/download.php?value=$value
                                </a><br /><br />
                                <h6 style = 'font-weight: bold'>Tags:</h6>
                                <p>Select Tag(s) that you want to Edit or Delete</p>
                            </div>";
                            
                            $addedon = $row['createdat'];
                            $category = $row['cat_name'];
                        }
                    }catch(PDOException $e){
                        echo "An error occured ". $e;
                    }
                    ?>
                    <form action = "" method = "POST">
                        <?php
                            echo "<div style = 'text-align: center'>";
                            try{
                                $del = '';
                                $sql = "SELECT * FROM tagdetails  WHERE d_id = '$id' ORDER BY id ASC";
                                $result = $pdo->query($sql);
                                while($row = $result->fetch()){
                                    if ($row['alt'] != '1'){
                                        echo "
                                            <label class = 'checkbox-inline' style = 'margin-left: 2%; padding-top: -2%;'>
                                                <input type = 'checkbox' class = 'tagcheckbox' name = 'check_list[]' value = '$row[id]'>
                                                $row[tagname]
                                                <div class = 'tagidcontainer' style = 'display: none'>
                                                    <input = 'text' name = 'edittag[]' id = 'edittag' placeholder = 'Edit $row[tagname]' class = 'form-control'>
                                                    <input type = 'hidden' name = 'tagids[]' value = '$row[id]'>
                                                </div>
                                            </label><br />
                                        ";
                                    }
                                    $del = "Not Empty";
                                } 
                            }catch(PDOException $e){
                                echo "An error occured. " .$e;
                            }
                            if($del != '') {
                                echo "
                                <button id = 'tageditbtn' class = 'btn btn-primary' style = 'margin-left: 2%;'>Edit</button>
                                <input type = 'submit' name = 'submitedit' id = 'submitedit' value = 'Save' class = 'btn btn-success' style = 'margin-left: 2%; display: none;'>
                                <input type = 'submit' name = 'tagdelete' id = 'tagdelete' value = 'REMOVE' class = 'btn btn-danger' style = 'margin-left: 2%;'>";
                            }

                            echo "</div><br /><br /><br />";
                        ?>
                    </form>
                </div>
                
                <div class = "col-lg-6" style = "margin-top: -40px;">
                    <div class = "row">
                        <div class = "col-lg-12">
                            <label style = "font-weight: bold; margin-left: -10px;">Category</label>
                        </div>
                        <div class = "col-lg-12 form-group">
                            <?php
                                try{
                                    $sql = "SELECT * FROM category ORDER BY cat_name ASC";
                                    $result = $pdo->query($sql);
                                    while($row = $result->fetch()){
                                        echo "<label class = 'checkbox-inline'>
                                            <input type = 'checkbox' name = 'catid[]' value = '$row[cat_id]'>
                                                $row[cat_name] &nbsp&nbsp&nbsp&nbsp
                                            </label>";
                                    } 
                                    }catch(PDOException $e){
                                        echo "An error occured. " .$e;
                                }
                            ?>
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-lg-12" style = "margin-left:10px;">
                            <label style = "font-weight: bold; margin-left: -10px;">Subategory</label>
                        </div>
                        <div class = "col-lg-12 form-group">
                            <?php
                                try{
                                $sql = "SELECT * FROM subcategory ORDER BY sub_name ASC";
                                $result = $pdo->query($sql);
                                while($row = $result->fetch()){
                                    echo "<label class = 'checkbox-inline'>
                                    <input type = 'checkbox' name = 'subid[]' value = '$row[sub_id]'>
                                        $row[sub_name] &nbsp&nbsp&nbsp&nbsp
                                    </label>";
                                } 
                                }catch(PDOException $e){
                                    echo "An error occured. " .$e;
                                }
                                echo "<br /><br />"
                            ?>
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                            <label style = "font-weight: bold; margin-left: -10px;">Image Title/Name</label>
                        </div>

                        <div class = "col-lg-12 form-group">
                            <input type = "text" name = "tag" class = "form-control" placeholder = "Image Title/Name">
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                            <label style = "font-weight: bold; margin-left: -10px;">Author</label>
                        </div>

                        <div class = "col-lg-12 form-group">
                            <input type = "text" name = "author" class = "form-control" placeholder = "Author">
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                            <label style = "font-weight: bold; margin-left: -10px;">Add More Tags</label>
                        </div>

                        <div class = "col-lg-12 form-group">
                            <input type = "text" name = "tag2" class = "form-control" placeholder = "Tags">
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                            <label style = "font-weight: bold; margin-left: -10px;">Author Link</label>
                        </div>

                        <div class = "col-lg-12 form-group">
                            <input type = "text" name = "authorlink" class = "form-control" placeholder = "Author Link">
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                            <label style = "font-weight: bold; margin-left: -10px;">Displayed Resolutions</label>
                        </div>

                        <div class = "col-lg-12 form-group">
                            <?php 
                                try{
                                    $sql = "SELECT * FROM resolutions WHERE d_id = '$id'";
                                    $result = $pdo->query($sql);
                                    while ($row = $result->fetch()){
                                        if ($row['active'] == '1'){
                                            echo "<input type = 'checkbox' name = 'res_id[]' value = '$row[r_id]' checked> $row[width] X $row[height] &nbsp; &nbsp;";
                                        }else{
                                            echo "<input type = 'checkbox' name = 'res_id[]' value = '$row[r_id]'> $row[width] X $row[height] &nbsp; &nbsp;";
                                        }
                                    }
                                }catch(PDOException $e){
                                    echo "An error just occured ".$e;
                                    $status = "failed";
                                }
                            ?>
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-lg-12" style = "margin-left:10px; margin-top: -20px;">
                            <label style = "font-weight: bold; margin-left: -10px;">Image Description</label>
                        </div>

                        <div class = "col-lg-12 form-group">
                            <textarea name = "imagedescription" class = "form-control" maxlength = 300 rows = 3></textarea>
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-lg-12">
                            <input type = "submit" name = "submit" class = "btn btn-primary pull-left" value = "Update" style = "height:50px; width:200px; font-size:25px; margin-top: -30px; background-color: black;">
                        </div>
                    </div>
                </div>
            </div>
        </form><br />
    </div>
    <!-- End of code for the Add image form -->
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});
</script>

<script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'imagedescription' );
</script>

<script src="vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#tageditbtn").click(function(e){
            e.preventDefault();
            $("#submitedit").show();
            $("#tageditbtn").hide();
            $(".tagcheckbox").hide();
            $(".tagidcontainer").show();
            $("#tagdelete").hide();
            $(".checkbox-inline").css({
                fontWeight: 'bold'
            });
        });
    });
</script>
</body>
</html>