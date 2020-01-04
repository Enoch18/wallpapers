<?php
include ('session.php');
include ('../database/connection.php');
include ('inc.php');

$result = '';
$catname = '';
$failed = '';
$id = $_GET['cat_id'];
if(isset($_POST['submit'])){
    try{
        if($id == ''){
            $subname = $_POST['subname']; 
            $catid = $_POST['catid'];
            $creationdate = date('Y-m-d');
            $creationtime = date('H:i:s');
        
            
            $sql = "INSERT INTO subcategory SET
            cat_id = :catid,
            sub_name = :subname,
            creationdate = :creationdate,
            creationtime = :creationtime
            ";
            $s = $pdo->prepare($sql);
            
            $s->bindValue(':catid', $catid);
            $s->bindValue(':subname', $subname);
            $s->bindValue(':creationdate', $creationdate);
            $s->bindValue(':creationtime', $creationtime);
            $s->execute();
            $_SESSION['success'] = $subname . " was added successfully!";
            header("Location: viewsubcategories.php");
        }

        if($id != ''){
            $subname = $_POST['subname']; 
            $catid = $id;
            $creationdate = date('Y-m-d');
            $creationtime = date('H:i:s');
        
            
            $sql = "INSERT INTO subcategory SET
            cat_id = :catid,
            sub_name = :subname,
            creationdate = :creationdate,
            creationtime = :creationtime
            ";
            $s = $pdo->prepare($sql);
            
            $s->bindValue(':catid', $catid);
            $s->bindValue(':subname', $subname);
            $s->bindValue(':creationdate', $creationdate);
            $s->bindValue(':creationtime', $creationtime);
            $s->execute();
            $result = $subname . " was added successfully!";
            header("Location: catdetails.php?id=$id");
        }
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
                <h2 style = "margin-top: 5%; margin-left: -10px;">Add Subcategory</h2>
                <?php if ($result != '') echo "<p style = 'background-color: green; color: white;'>$result</p>" ?>
                <?php if ($failed == '') echo "<p style = 'background-color: red; color: white;'>$failed</p>" ?>

                <?php 
                    if($id == ''){
                        echo "
                        <div class = 'row'>
                            <div class = 'col-lg-12' style = 'margin-left:10px;'>
                                <label style = 'font-weight: bold; margin-left: -10px;'>Choose Category</label>
                            </div>
                            
                            <div class = 'col-lg-12 form-group'>
                                <select name = 'catid' class = 'form-control'>";
                                        try{
                                        $sql = "SELECT * FROM category ORDER BY cat_name ASC";
                                        $result = $pdo->query($sql);
                                        while($row = $result->fetch()){
                                            echo "<option value = '$row[cat_id]'>$row[cat_name]</option>";
                                        } 
                                        }catch(PDOException $e){
                                            echo "An error occured. " .$e;
                                        }
                                echo"
                                </select>
                            </div>
                        </div>
                        <div class = 'row'>
                            <div class = 'col-lg-12'>
                                <label style = 'font-weight:bold;'>Subcategory Name</label>
                            </div>
                            <div class = 'col-lg-12 form-group'>
                            <input type = 'text' name = 'subname' placeholder = 'Category Name' class = 'form-control'>
                            </div>
                        </div>
                        ";
                    }
                ?>

                <?php 
                    if($id != ''){
                        echo "
                        <div class = 'row'>
                            <div class = 'col-lg-12'>
                                <label style = 'font-weight:bold;'>Subcategory Name</label>
                            </div>
                            <div class = 'col-lg-12 form-group'>
                            <input type = 'text' name = 'subname' placeholder = 'Category Name' class = 'form-control'>
                            </div>
                        </div>";
                    }
                ?>
                 
                <div class = "row">
                    <div class = "col-lg-12">
                        <input type = "submit" name = "submit" value = "Add" class = "btn btn-primary pull-left" style = "height:50px; width:150px; font-size:25px;">
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