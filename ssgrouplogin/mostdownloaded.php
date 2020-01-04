<?php
include ('session.php');
include_once ('../database/connection.php');
include ('inc.php');
?>
<style>
img:hover{
    opacity: 0.7;
}
</style>
<!-- Page Content -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>

    <div class = "container">
        <form action = "" method = "post" enctype = "multipart/form-data">
                <h4 style = "margin-top: 5%;">TOP DOWNLOADED</h4>
                <div class = "row">
                    <?php
                        //Code for most downloaded Category
                        // try{
                        //     echo "
                        //         <div class = 'col-md-12 col-md-12 col-md-12 col-lg-12'>
                        //             <h5 style = 'margin-top: 5%;'>Most Downloaded Categories</h5><br />
                        //         </div>";
                        //     $sql = "SELECT * FROM downloads AS d, resolutions AS r, category AS c, details AS det, catlink AS cl
                        //     WHERE cl.cat_id = c.cat_id AND det.d_id = cl.d_id AND r.d_id = d.d_id AND c.cat_id = cl.cat_id AND d.d_id = det.d_id AND r.width = '1920' AND r.height = '1080'
                        //     GROUP BY d.d_id 
                        //     ORDER BY d.counter DESC";
                        //     $result = $pdo->query($sql);
                        //     while ($row = $result->fetch()){
                        //         echo "
                        //             <div class = 'col-md-2 col-md-2 col-md-2 col-lg-2'>
                        //                 <a href = 'viewwallpapers.php?catname=$row[cat_name]' class = 'btn btn-primary' style = 'width: 100%;'>$row[cat_name]</a>
                        //             </div>
                        //         ";
                        //     }
                        // } catch(PDOException $e){
                        //     echo "Error " . $e;
                        // }
                        //End of Code for most downloaded Category
                    
                        //Code for most downloaded Image
                        try{
                            echo "
                                <div class = 'col-md-12 col-md-12 col-md-12 col-lg-12'>
                                    <h5 style = 'margin-top: 5%;'>Most Downloaded Images</h5><br />
                                </div>";
                            $sql = "SELECT * FROM downloads AS da, details AS d, resolutions AS r
                            WHERE r.d_id = d.d_id AND d.d_id = da.d_id AND r.original != 'original' 
                            AND r.width = '1920' AND r.height = '1080' 
                            GROUP BY da.d_id 
                            ORDER BY da.counter DESC";
                            $result = $pdo->query($sql);
                            while ($row = $result->fetch()){
                                $sqld = "SELECT * FROM downloads WHERE d_id = '$row[d_id]'";
                                $resultd = $pdo->query($sqld);
                                $number = array();
                                while ($rowd = $resultd->fetch()){
                                    $downloads = $rowd['counter'];
                                }
                                if ($downloads == 1){
                                    $downloads =  $downloads. " Download";
                                }else{
                                    $downloads = $downloads . " Downloads";
                                }
                                echo "
                                    <div class = 'col-md-12 col-md-6 col-md-4 col-lg-4'>
                                        <a href = 'viewwallpapers.php?search=$row[tag]'>
                                            <img src = '$row[url]' class = 'img-thumbnail img-responsive'>
                                        </a>
                                        <h6>$downloads</h6>
                                    </div>
                                ";
                            }
                        } catch(PDOException $e){
                            echo "Error " . $e;
                        }
                        //End of Code for most downloaded Image
                    ?>
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