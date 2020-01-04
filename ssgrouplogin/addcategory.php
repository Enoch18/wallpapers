<?php
include ('session.php');
include ('../database/connection.php');
include ('inc.php');

$result = '';
$catname = '';
$failed = '';
if(isset($_POST['submit'])){
    try{
        $catname = $_POST['catname']; 
        $creationdate = date('Y-m-d');
        $creationtime = date('H:i:s');
    
        
        $sql = "INSERT INTO category SET
        cat_name = :cat_name,
        creationdate = :creationdate,
        creationtime = :creationtime
        ";
        $s = $pdo->prepare($sql);
        
        $s->bindValue(':cat_name', $catname);
        $s->bindValue(':creationdate', $creationdate);
        $s->bindValue(':creationtime', $creationtime);
        $s->execute();
        $result = $catname . " was added successfully!";
        //header("Location: addcategory.php");
    }catch(PDOException $e){
        echo "We could not upload : " . $e;
    }
}
?>
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>

    <div class = "container">
        <form action = "" method = "post" enctype = "multipart/form-data" class = "form-group">
                <h2 style = "margin-top: 5%; margin-left: -10px;">Add Category</h2>
                <?php if ($result != '') echo "<p style = 'background-color: green; color: white;'>$result</p>" ?>
                <?php if ($failed == '') echo "<p style = 'background-color: red; color: white;'>$failed</p>" ?>

                <div class = "row">
                    <div class = "col-lg-12">
                        <label style = "font-size: 20px; font-weight:bold; margin-left: -10px;">Category Name</label>
                    </div>
                    <input type = "text" name = "catname" placeholder = "Category Name" class = "form-control"><br />
                </div>
                 
                <div class = "row">
                    <div class = "col-lg-12">
                        <input type = "submit" name = "submit" value = "Add Category" class = "btn btn-primary pull-left" style = "height:50px; width:200px; margin-left:-15px; font-size:25px;">
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