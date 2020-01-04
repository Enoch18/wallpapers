<?php
error_reporting(0);
include ('session.php');
include ('inc.php');
include ('../database/connection.php');

$subid = $_GET['subid'];
$catid = $_GET['catid'];


if($subid != ''){
    try{
        $did = '';
        $sql1 = "SELECT * FROM subcatlink AS sl, details AS d WHERE d.d_id = sl.d_id AND sub_id = '$catid'";
        $result1 = $pdo->query($sql1);
        while($row1 = $result1->fetch()){
            $did = $row1['d_id'];
        }

        try{
            $sql = "SELECT * FROM resolutions WHERE d_id = '$did'";
            $result = $pdo->query($sql);
            while($row = $result->fetch()){
                unlink($row['url']);
            }
        }catch(PDOException $e){
            echo "An error occured: " . $e;
        }

        $sql3 = "DELETE FROM resolutions WHERE d_id = '$did'";
        $pdo->exec($sql3);

        $sql4 = "DELETE FROM details WHERE d_id = '$did'";
        $pdo->exec($sql4);

        $sql5 = "DELETE FROM subcategory WHERE sub_id = '$subid'";
        $pdo->exec($sql5);

        $sql6 = "DELETE FROM downloads WHERE d_id = '$did'";
        $pdo->exec($sql6);

        $_SESSION['success'] = "Deleted successfully!!!";
        header("Location: viewsubcategories.php");
    }catch(PDOException $e){
        echo "Error " . $e;
    }
}
?>
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>
    <div class = "container">
        <div id = "subcategories">
            <h4 style = "margin-top: 5%; text-align: center;">SUBCATEGORIES</h4><br /><br />
            <?php 
                if ($_SESSION['success'] != ''){
                    echo "
                        <div style = 'width: 100%; background-color: green; color: white;'><h6>$_SESSION[success]</h6></div>
                    ";
                }
            ?>
            <div class = "col-lg-12">
                <ul class = "list-group">
                    <?php 
                        $total = $pdo->query('SELECT COUNT(*) FROM subcategory')->fetchColumn();
                        if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                        } else {
                            $pageno = 1;
                        }
                        $prev = $pageno - 1;
                        $next = $pageno + 1;
                        $no_of_records_per_page = 10;
                        $offset = ($pageno-1) * $no_of_records_per_page;
                        $pages = ceil($total/$no_of_records_per_page);
                        try{
                            $sql = "SELECT * FROM subcategory ORDER BY sub_name ASC LIMIT $offset, $no_of_records_per_page";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                if($row['sub_name'] != ''){
                                echo "<li class = 'list-group-item' style = 'background-color: white !important;'>
                                        <div class = 'row' style = 'margin-top: -5px;'>
                                            <div class = 'col-lg-8'>
                                                <h5 style = 'color:black;'>$row[sub_name]</h5>
                                            </div>

                                            <div class = 'col-lg-4'>
                                                <a href = 'renamesub?id=$row[sub_id]' class = 'btn btn-primary'>
                                                    Rename
                                                </a>
                                                <a href = '?subid=$row[sub_id]' class = 'btn btn-danger'>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                      </li>";
                                }
                            }
                        }catch(PDOException $e){
                            echo "An error occured ". $e;  
                        }
                    ?>
                    <div class = "container" id = "pages">
                    <!-- Beginnig of Code for Page Numbers -->
                    <div class = "col-lg-12" id = "#_">
                    <?php if ($pages == 1 && !($pages > 1)){ ?>
                        <br />
                        <ul class = "pagination">           
                            <li><a href = "#_" class = "btn btn-primary">First</a>
                            <li><a href = "?pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno ?></a>
                            <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p>
                            <li><a href = "?pageno=<?php echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages ?></a><li>
                            <?php
                                if ($pages == 1 && !($pages > 1)){
                                    echo "<li><a href = '#_' class = 'btn btn-primary' style = 'margin-left: 20px; color:white;'>Last</a></li>";
                                }
                            ?>
                        </ul>
                        <?php } ?>

                        <?php if ($pages > 1 && $pageno < $pages){ ?>
                            <br />
                            <ul class = "pagination"> 
                            <?php if ($pageno == 1){ ?>          
                                <li><a href = "#_" class = "btn btn-primary">First</a>
                            <?php } ?>

                            <?php if ($pageno > 1){ ?>          
                                <li><a href = "?pageno=<?php echo $pageno - 1; ?>" class = "btn btn-primary"><<< </a>
                            <?php } ?>
                            <li><a href = "?pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno ?></a>
                            <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p>
                            <li><a href = "?pageno=<?php echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages ?></a><li>
                            <li><a href = "?pageno=<?php echo $pageno + 1; ?>" class = 'btn btn-primary' style = 'margin-left: 20px;'>>>> </a>
                            </ul>
                        <?php } ?>

                        <?php if ($pageno == $pages && $pages != 1){ ?>
                            <br />
                            <ul class = "pagination">           
                                <li><a href = "?pageno=<?php echo $pageno - 1; ?>" class = "btn btn-primary"> <<< </a>
                                <li><a href = "?pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno ?></a>
                                <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p>
                                <li><a href = "?pageno=<?php echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages ?></a><li>
                                <li><a href = "#_" class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a>
                            </ul>
                    <?php } ?>

    <?php if ($pages == 0 || $pages < 0){ ?>
        <br />
        <h4 style = "color: white;">You currently do not have any registered users</h4>
        <?php } ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                    <!-- End of Code for Page Numbers -->
                    </div>
                    <br /><br /><a href = 'addsubcategory.php' class = 'btn btn-primary'>ADD SUBCATEGORIES</a><br />
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