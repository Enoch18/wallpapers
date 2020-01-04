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
            <h4 style = "margin-top: 5%; margin-left: 15px;">UNSUBSCRIBERS</h4>
            <div class = "col-lg-12">
                <ul class = "list-group">
                    <?php 
                        try{
                            $sql = "SELECT * FROM unsubscribers ORDER BY id DESC";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                echo "<li class = 'list-group-item' style = 'background-color: white !important;'>
                                        <div class = 'col-lg-8'>
                                            <h6 style = 'color:black;'>Email: $row[email]</h6>
                                            <h6 style = 'color:black;'>Subscription Date: $row[timestamp]
                                        </div>
                                      </li>";
                            }
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