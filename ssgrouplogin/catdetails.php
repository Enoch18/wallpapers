<?php
error_reporting(0);
include ('session.php');
include ('inc.php');
include ('../database/connection.php');

$id = $_GET['id'];
$subid = $_GET['subid'];
if($subid != ''){
    try{
        $sql = "DELETE FROM subcategory WHERE sub_id = '$subid'";
        $pdo->exec($sql);
        header("Location: catdetails.php?id=${id}");
        $result = $cat . " has been deleted successfully!!!";
    }catch(PDOException $e){
        $failed = "Failed to add the image!!!" . $e;
    }
}

if($catid != ''){
    try{
        $sql = "DELETE FROM category WHERE cat_id = '$catid'";
        $pdo->exec($sql);
        $result = $cat . " has been deleted successfully!!!";
    }catch(PDOException $e){
        $failed = "Failed to add the image!!!" . $e;
    }
    echo $_SESSION['newname'];
    exit();
}
?>
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>
    <div class = "container">
        <div id = "subcategories">
            <h4 style = "margin-top: 5%; text-align: center;">CATEGORIES DETAILS</h4><br /><br />
            <?php 
                if ($_SESSION['newname'] != '' && $_SESSION['former'] != ''){
                    echo "
                        <div style = 'width: 100%; background-color: green; color: white;'><h6>Renamed from $_SESSION[former] to $_SESSION[newname] done!</div>
                    ";
                }
            ?>
            <div class = "col-lg-12">
                <ul class = "list-group">
                    <?php 
                        try{
                            //Beginning of code for number of categories
                            $number = array();
                            $total = '';
                            echo "<h5>Subcategories</h5>";
                            $sql = "SELECT * FROM subcategory WHERE cat_id = '$id' ORDER BY sub_name ASC";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                echo "<li class = 'list-group-item' style = 'background-color: white !important;'>
                                        <div class = 'row' style = 'margin-top: -5px;'>
                                            <div class = 'col-lg-8'>
                                                <h5 style = 'color:black;'>$row[sub_name]</h5>
                                            </div>

                                            <div class = 'col-lg-4'>
                                                <a href = 'renamesub?id=$row[sub_id]' class = 'btn btn-primary'>
                                                    Rename
                                                </a>
                                                <a href = '?id=$id&subid=$row[sub_id]' class = 'btn btn-danger'>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                      </li>";
                                $number[] = $row['sub_id'];
                            }
                            $total = count($number);
                            //End of code for number of categories

                            //Beginning of code for number of wallpapers
                            $number2 = array();
                            $total2 = '';
                            $sql2 = "SELECT * FROM details AS d, catlink AS cl WHERE cl.cat_id = '$id' AND d.d_id = cl.d_id";
                            $result2 = $pdo->query($sql2);
                            while($row2 = $result2->fetch()){
                                $number2[] = $row2['d_id'];
                            }
                            $total2 = count($number2);
                            //End of code for number of wallpapers
                            
                            $updatedate = array();
                            $updatetime = '';
                            $catid = '';
                            $sql3 = "SELECT * FROM category AS c, catlink AS cl, details AS d WHERE c.cat_id = '$id' AND cl.d_id = d.d_id AND cl.cat_id = c.cat_id ORDER BY creationdate DESC";
                            $result3 = $pdo->query($sql3);
                            while($row3 = $result3->fetch()){
                               $updatedate[] = $row3['createdat'];
                               $catid = $row3['cat_id'];
                            }

                            $update = max($updatedate);

                            echo "<br /><a href = 'addsubcategory.php?cat_id=$catid' class = 'btn btn-primary'>Add Subcategory</a><br />";
                        }catch(PDOException $e){
                            echo "An error occured ". $e;
                        }
                        echo "<br /><h5> 
                                Total Subcategories: $total <br />
                                Total Category Wallpapers: $total2 <br />
                                Last Category Update: $update
                             </h5>
                            ";
                    ?>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- /#page-content-wrapper -->
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