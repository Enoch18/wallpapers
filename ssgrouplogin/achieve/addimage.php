<?php
include ('session.php');
include ('inc.php');
include ('../database/connection.php');
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>

    <!-- Beginning of code for the Add image form -->
    <div class = "container">
                <div class = "progress" style = "margin-top: 100px; display:none;">
                    <div class = "progress-bar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div> 
                </div>
                <div id = "loader-icon" style = "display:none;">
                    <img src = "loader.gif" style = "width: 70%; margin-left: 10%;">
                </div>

        <form method = "post" id = "data" enctype = "multipart/form-data">
                <h2 style = "margin-top: 10%;">Add Images</h2><br />
                <p style = 'background-color:green; font-weight: bold; color: white;' id = "result"></p>
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
                        <input type = "text" name = "tag2" id = "tag2" class = "form-control" placeholder = "Tags">
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Upload Image</label>
                    </div>

                    <div class = "col-lg-12 form-group">
                        <input type = "file" name = "image" id = "image" class = "form-control" required>
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
                    <!-- <input type = "submit" id = "uploadSubmit" name = "submit" class = "btn btn-primary pull-left" value = "Add" style = "height:50px; width:200px; font-size:25px; margin-top: -30px;"> -->
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
            $('.progress').show();  
            $('#loader-icon').show();
            var formData = new FormData(this);

            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){
                        myXhr.upload.addEventListener('progress',progress, true);
                    }
                    return myXhr;
                },
                success: function (data) {
                    $('#data').show();
                    $('.progress').hide(); 
                    $('#loader-icon').hide(); 
                    $('#result').html("<b>Uploaded Successfully");
                    $("form#data")[0].reset();
                },
                resetForm: true,
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function progress(e){

            if(e.lengthComputable){
                var max = e.total;
                var current = e.loaded;

                var Percentage = (current * 100)/max;
                $('.progress-bar').width(Percentage + '%').html("<b>"+ Percentage +"%</b>");

                if(Percentage >= 100)
                {
                    $('.progress-bar').hide();
                // process completed  
                }
            }  
        }
    });
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