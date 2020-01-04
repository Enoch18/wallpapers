<?php
include ('session.php');
include_once ('../database/connection.php');
include ('inc.php');

$id = $_GET['id'];

if(isset($_POST['submit'])){
    $subname = $_POST['catrename'];
    $formername = $_POST['former'];
    try{
        $sql = "UPDATE subcategory SET
        sub_name = :subname
        WHERE sub_id = $id";
        $s = $pdo->prepare($sql);
        $s->bindValue(':subname', $subname);
        $s->execute();
        header("Location: viewsubcategories.php");
    }catch(PDOException $e){
        $failed = "Failed to add the image!!!" . $e;
    }
}
?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>

    <div class = "container">
        <form action = "" method = "post" enctype = "multipart/form-data">
                <h4 style = "margin-top: 10%;">RENAME CATEGORY</h4>
                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Current Name</label>
                    </div>
                    <div class = "col-lg-12 form-group">
                        <?php
                            try{
                                   $sql = "SELECT * FROM subcategory WHERE sub_id = '$id'";
                                   $result = $pdo->query($sql);
                                   while($row = $result->fetch()){
                                        echo "
                                        <h5 class = 'form-control'>Current Name: $row[sub_name] </h5>
                                        <input type = 'hidden' name = 'former' value = '$row[sub_name]'>
                                        ";
                                   } 
                                }catch(PDOException $e){
                                    echo "An error occured. " .$e;
                                }
                        ?>

                        <div class = "col-lg-12" style = "margin-left:10px;">
                            <br />
                            <label style = "font-weight: bold; margin-left: -20px;">Rename to</label>
                        </div>
                        <input type = "text" name = "catrename" class = "form-control" placeholder = "Rename to">
                        <div class = "row">
                            <div class = "col-lg-12">
                                <br />
                                <input type = "submit" name = "submit" class = "btn btn-primary pull-left" value = "Save" style = "height:50px; width:100px; font-size:25px; margin-top: -30px;">
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
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

</body>
</html>