<?php
session_start();
include ('session.php');
include ('inc.php');
include ('../database/connection.php');

$rcheck = '';
$img = '';
$num = array();
$max = '';
try{
$sql = "SELECT * FROM details";
$result = $pdo->query($sql);
while($row = $result->fetch()){
    $num[] = $row['d_id'];
}
$max = max($num);
}catch(PDOException $e){
    echo "Error " . $e;
}

try{
$sql = "SELECT * FROM resolutions WHERE d_id = '$max'";
$result = $pdo->query($sql);
while($row = $result->fetch()){
    $img = $row['url'];
    if($row['width'] == "1920" && $row['height'] == "1080"){
        $rcheck = "present";
    }
}
$max = max($num);
}catch(PDOException $e){
    echo "Error " . $e;
}

if($rcheck != "present"){
    $sql2 = "DELETE FROM details WHERE d_id = '$max'";
    $pdo->exec($sql2);

    $sql1 = "DELETE FROM resolutions WHERE d_id = '$max'";
    $pdo->exec($sql1);

    $sql3 = "DELETE FROM catlink WHERE d_id = '$max'";
    $pdo->exec($sql3);

    $sql4 = "DELETE FROM subcatlink WHERE d_id = '$max'";
    $pdo->exec($sql4);

    $sql5 = "DELETE FROM tagdetails WHERE d_id = '$max'";
    $pdo->exec($sql5);

    $sql = "SELECT * FROM resolutions WHERE d_id = '$max'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        unlink($row['url']);
    }
}
$fullPath = __DIR__ . "./" ;
array_map('unlink', glob( "$fullPath*.log"));

$result = '';
$failed = '';
?>

<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>

    <!-- Beginning of code for the Add image form -->
    <div class = "container">
        <div class = "row" id = "uploading" style = "display:none;">
            <div class = "col-lg-12">
                <h2 style = "margin-top: 30%; text-align:center; color:gray;">Uploading . . .</h2>
            </div>
        </div>
        <form method = "post" id = "data" enctype = "multipart/form-data">
                <h2 style = "margin-top: 10%;">Add Images</h2><br />
                <p style = 'background-color:green; font-weight: bold; color: white; display:none;' id = "result"></p>
                <p style = 'background-color:red; font-weight: bold; color: white; display:none;' id = "failed"></p>
                <?php if ($result != '') echo "<p style = 'background-color:green; font-weight: bold; color: white;'>$result</p>"; ?>
                <?php if ($failed != '') echo "<p style = 'background-color:red; font-weight: bold; color: white;'>$failed</p>"; ?>
                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Choose Category</label>
                    </div>
                    <div class = "col-lg-12 form-group">
                        <?php
                            try{
                                $sql = "SELECT * FROM category ORDER BY cat_name ASC";
                                $result = $pdo->query($sql);
                                while($row = $result->fetch()){
                                    echo "<label class = 'checkbox-inline'>
                                        <input type = 'checkbox' name = 'catid[]' class ='catid' value = '$row[cat_id]'>
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
                        <label style = "font-weight: bold; margin-left: -10px;">Choose Subcategory</label>
                    </div>
                    <div class = "col-lg-12 form-group">
                        <?php
                            try{
                               $sql = "SELECT * FROM subcategory ORDER BY sub_name ASC";
                               $result = $pdo->query($sql);
                               while($row = $result->fetch()){
                                echo "<label class = 'checkbox-inline'>
                                <input type = 'checkbox' name = 'subid[]' class = 'subid' value = '$row[sub_id]'>
                                    $row[sub_name] &nbsp&nbsp&nbsp&nbsp
                                </label>";
                               } 
                            }catch(PDOException $e){
                                echo "An error occured. " .$e;
                            }
                        ?>
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Image Title/Name</label>
                    </div>

                    <div class = "col-lg-12 form-group">
                        <input type = "text" name = "tag" id = "tag" class = "form-control" placeholder = "Image Title/Name" required>
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Tags</label>
                    </div>
                        
                    <div class = "col-lg-12 form-group">
                        <textarea type = "text" name = "tag2" id = "tag2" class = "form-control" rows = "5"></textarea>
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Alt Tags</label>
                    </div>
                        
                    <div class = "col-lg-12 form-group">
                        <textarea type = "text" name = "alttags" id = "alttags" class = "form-control" rows = "5"></textarea>
                    </div>
                </div>

                <div class = "row" id = "uploaded">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                        <label for = "image" style = "font-weight: bold; margin-left: -10px;" id = "chomsg">
                            Choose Wallpaper
                        </label>

                        <label style = "font-weight: bold; margin-left: -10px; display:none;" id = "chomsg1">
                            You've chosen the wallpaper below. <br /><i style = "font-size: 12px;">Click on it to choose a different one</i>
                        </label>
                    </div><br />

                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -17px;">
                        <label for = "image" style = "font-weight: bold; margin-left: -10px;">
                            <img src = "file.png" style = "width: 15%; border: 2px solid gray; cursor: pointer;" id = "input">
                            <img src = "#" id = "image2" style = "display: none; cursor: pointer;" />
                            <img src = "loader.gif" style = "width:10%; display:none;" id = "load">
                        </label>
                    </div>
                    <div class = "col-lg-12 form-group">
                        <input type = "file" accept="image/jpeg" onchange="readURL(this);" name = "image" id = "image" class = "form-control" required>
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -20px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Image Description</label>
                    </div>

                    <div class = "col-lg-12 form-group">
                        <textarea name = "imagedescription" id = "imagedescription" required></textarea>
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Author's Name</label>
                    </div>

                    <div class = "col-lg-12 form-group">
                        <input type = "text" name = "author" id = "author" class = "form-control" placeholder = "Author's Name">
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Author's Link/Url</label>
                    </div>

                    <div class = "col-lg-12 form-group">
                        <input type = "text" name = "authorlink" id = "authorlink" class = "form-control" placeholder = "Author's Link/Url">
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Make live at</label>
                    </div>

                    <div class = "col-xs-2 col-sm-2 col-ms-2 col-lg-2 form-group">
                        <label>Time</label>
                        <input type = "time" name = "time" id = "time" class = "form-control">
                    </div>
                    <div class = "col-xs-3 col-sm-3 col-ms-3 col-lg-3 form-group">
                        <label>Date</label>
                        <input type = "date" name = "date" id = "date" class = "form-control">
                    </div>
                </div><br />
                        
            <div class = "row">
                <div class = "col-lg-12">
                    <!-- <input type = "submit" id = "uploadSubmit" name = "submit" class = "btn btn-primary pull-left" value = "Submit" style = "height:50px; width:200px; font-size:25px; margin-top: -30px;"> -->
                    <button class = "btn btn-primary pull-left" value = "Add" style = "height:50px; width:200px; font-size:25px; margin-top: -30px;">Submit</button>                
                </div>
            </div><br /><br />
        </form>
    </div>
    <!-- End of code for the Add image form -->
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="jquery.form.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("form#data").submit(function(event) {
            event.preventDefault();
            for (imagedescription in CKEDITOR.instances) {
                CKEDITOR.instances[imagedescription].updateElement();
            }
            
            $('#data').hide();
            $('#uploading').show();  

            var formData = new FormData(this);

            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $('#uploading').hide();  
                    $('#data').show();
                    $('.progress').hide(); 
                    $('#result').html("<b>Uploaded Successfully</b>");
                    $('#result').show();
                    $("#chomsg").show();
                    $("#chomsg1").hide();
                    $('#image2').hide();
                    $("#input").show();
                    for (imagedescription in CKEDITOR.instances) {
                        CKEDITOR.instances[imagedescription].setData('');
                    }
                    $("form#data")[0].reset();
                    setTimeout(function(){
                        window.location.reload(true);
                    }, 10000); 
                },
                resetForm: true,
                cache: false,
                contentType: false,
                processData: false
            });

            setTimeout(function(){
                $('#uploading').hide();  
                    $('#data').show();
                    $('.progress').hide(); 
                    $('#failed').html("<b>Failed to fully upload wallpaper some resolution/the wallpaper itself may not be displayed</b>");
                    $('#failed').show();
                    $("#chomsg").show();
                    $("#chomsg1").hide();
                    $('#image2').hide();
                    $("#input").show();
                    for (imagedescription in CKEDITOR.instances) {
                        CKEDITOR.instances[imagedescription].setData('');
                    }
                    $("form#data")[0].reset();
                    setTimeout(function(){
                        window.location.reload(true);
                    }, 10000); 
            }, 90000);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#chomsg").hide();
                $("#chomsg1").hide();
                $('#image2').hide();
                $("#input").hide();
                $("#load").show();

                setTimeout(function () {
                    var fullPath = $("#image").val();
                    var filename = fullPath.replace(/^.*[\\\/]/, '');
                    var imagename = filename.split('.').slice(0, -1).join('.')

                    $("#chomsg1").show();
                    $("#load").hide();
                    $("#tag").val(imagename);
                    $('#image2')
                    .show()
                    .attr('src', e.target.result)
                    .width(300)
                    .height(200);
                }, 1000);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
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
</body>
</html>