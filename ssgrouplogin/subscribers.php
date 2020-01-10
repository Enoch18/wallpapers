<?php
//error_reporting(0);
include ('session.php');
include ('inc.php');
include ('../database/connection.php');
?>
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>
    <div class = "container">
        <div id = "subcategories">
            <h4 style = "margin-top: 5%; margin-left: 15px;">SUBSCRIBERS</h4>
            <div class = "col-lg-12">
                <ul class = "list-group">
                    <?php 
                        try{
                            $total = '';
                            $num = array();

                            $sql = "SELECT * FROM subscribers ORDER BY id DESC";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                $num[] = $row['id'];
                            }
                            $total = count($num);

                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            $prev = $pageno - 1;
                            $next = $pageno + 1;
                            $no_of_records_per_page = 100;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $pages = ceil($total/$no_of_records_per_page);

                            echo "<div class = 'row' style='box-shadow: inset 0 0 5px gray; padding: 10px;'>";
                            $sql = "SELECT * FROM subscribers ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                echo "
                                    <div class = 'col-xs-12 col-sm-12 col-md-6 col-lg-6'>
                                        <li class = 'list-group-item' style = 'background-color: white !important;'>
                                            <div class = 'col-lg-8'>
                                                <h6 style = 'color:black;'>Email: $row[email]</h6>
                                                <h6 style = 'color:black;'>Subscription Date: $row[timestamp]
                                            </div>
                                        </li>
                                    </div>
                                ";
                            }
                            echo "</div>";

                            echo"
                            <div class = 'col-lg-12'>
                            <div class = 'container' id = 'pages'>";
                            if ($pageno == 1 && $pages > 0){
                                $pos = $pageno + 1;
                                $neg = $pageno - 1;
                                echo"
                                <br />
                                <ul class = 'pagination'>           
                                    <li><a href = '#_' class = 'btn btn-primary'>First</a>
                                    <li><a href = '?pageno=$pageno' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pageno</a>
                                    <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>Out of</p>
                                    <li><a href = '?pageno=$pages' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pages</a><li>
                                    <li>";
                                    if($pages == 1){
                                    echo "
                                    <a href = '#_' class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a>
                                    </ul>";
                                    }
                                    if($pages > 1){
                                        echo "
                                        <a href = '?pageno=$pos' class = 'btn btn-primary' style = 'margin-left: 20px;'> >>> </a>
                                        </ul>";
                                    }
                            }

                            if ($pageno >= 2 && $pageno != $pages){
                                $pos = $pageno + 1;
                                $neg = $pageno - 1;
                                echo"
                                <br />
                                <ul class = 'pagination'>           
                                    <li><a href = '?pageno=$neg' class = 'btn btn-primary'> <<< </a>
                                    <li><a href = '?pageno=$pageno' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pageno</a>
                                    <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>Of</p>
                                    <li><a href = '?pageno=$pages' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pages</a><li>
                                    <li>";
                                    
                                    echo "<a href = '?pageno=$pos' class = 'btn btn-primary' style = 'margin-left: 20px;'> >>> </a>
                                    </li>
                                </ul>";
                            }

                            if ($pageno == $pages && $pages != 1){
                                $neg = $pageno - 1;
                                echo"
                                <br />
                                <ul class = 'pagination'>           
                                    <li><a href = '?pageno=$neg' class = 'btn btn-primary'> <<< </a>
                                    <li><a href = '?pageno=$pageno' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pageno</a>
                                    <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>Out of</p>
                                    <li><a href = '?pageno=$pages' class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>$pages</a><li>
                                    <li><a href = '#_' class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a>
                                </ul>";
                            }
                            echo"</div></div>";
                        }catch(PDOException $e){
                            echo "An error occured ". $e;
                        }
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