<?php
include ('session.php');
include ('inc.php');
include ('../database/connection.php');

if (isset($_POST['submit'])){
    $name = $_POST['check_list'];
    $total = count($name);

    for($i=0; $i < $total; $i++){
        $timestamp = date("Y-m-d H:i:s");
        $sql = "INSERT INTO frontpage SET
        c_id = :catid,
        timestamp = :timestamp";
        
        $s = $pdo->prepare($sql);
        $s->bindValue(':catid', $name[$i]);
        $s->bindValue(':timestamp', $timestamp);
        $s->execute();
    }
}

if (isset($_POST['delete'])){
    $name = $_POST['check_list'];
    $total = count($name);

    for($i=0; $i < $total; $i++){
        $sql = "DELETE FROM frontpage WHERE c_id = $name[$i]";
        $pdo->exec($sql);
    }
}

if (isset($_POST['tagsubmit'])){
    $tagid = $_POST['check_list'];
    $total = count($tagid);
    $id = '';

    for($i=0; $i < $total; $i++){
        $tagname = $_POST['check_list'][$i];
        $sqlt = "SELECT * FROM tagdetails WHERE tagname = '$tagname'";
        $result = $pdo->query($sqlt);
        while ($row = $result->fetch()){
            $id = $row['id'];
        }
        $sql = "INSERT INTO tags SET
        tag_id = :tagid";
        
        $s = $pdo->prepare($sql);
        $s->bindValue(':tagid', $id);
        $s->execute();
    }
}

if (isset($_POST['tagdelete'])){
    $tagid = $_POST['check_list'];
    $total = count($tagid);

    for($i=0; $i < $total; $i++){
        $sql = "DELETE FROM tags WHERE tag_id = $tagid[$i]";
        $pdo->exec($sql);
    }
}
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>

    <div class = "container">
        <h5 style = "text-align:center; margin-top: 5%;">ACTIVE TAGS</h5>
        <div class = "row">
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php
                    try{
                        $sql = "SELECT * FROM tagdetails AS td, tags AS t WHERE td.id = t.tag_id GROUP BY td.tagname ORDER BY td.tagname ASC";
                        $result = $pdo->query($sql);
                        while($row = $result->fetch()){
                            $tag = $row['tagname'];
                            $num = array();
                            $sql1 = "SELECT * FROM tagdetails WHERE tagname LIKE '$tag'";
                            $result1 = $pdo->query($sql1);
                            while($row1 = $result1->fetch()){
                                $num[] = $row1['id'];
                            }
                            $count = count($num);
                            echo "
                                <label>
                                    $row[tagname] ($count)&nbsp&nbsp&nbsp&nbsp&nbsp
                                </label>
                            ";
                        }
                    }catch(PDOException $e){
                        echo "An error occured. " .$e;
                    }
                ?>
            </div>
        </div>
    </div>
    </div>
    <!-- End of code for the Add image form -->
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