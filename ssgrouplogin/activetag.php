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
        <h5 style = "text-align:center; margin-top: 5%;">CHOOSE POPULAR TAGS</h5>
        <div class = "row">
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form action = "" method = "POST">
                    <?php
                        try{
                            $del = '';
                            echo "<h5>Tags Shown: </h5>";
                            $sql = "SELECT DISTINCT tagname, id FROM tagdetails  AS t, tags AS ta WHERE ta.tag_id = t.id";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                echo "
                                    <label class = 'checkbox-inline'>
                                        <input type = 'checkbox' name = 'check_list[]' value = '$row[id]'>
                                        $row[tagname]&nbsp&nbsp&nbsp&nbsp&nbsp
                                    </label>
                                ";
                                $del = 'Not Empty';
                            } 
                        }catch(PDOException $e){
                            echo "An error occured. " .$e;
                        }
                        echo "<br />";
                        if($del != '') echo "<input type = 'submit' name = 'tagdelete' value = 'REMOVE' class = 'btn btn-danger'><br /><br />";
                    ?>
                </form>
                <hr />
            </div>

            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form action = "" method = "post" enctype = "multipart/form-data">
                    <?php
                        try{
                            $tot = array();
                            $sql = "SELECT DISTINCT tagname FROM tagdetails GROUP BY tagname ORDER BY tagname ASC LIMIT 200";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                $tot[] = $row['tagname'];
                            }
                            $total = count($tot);
                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            $prev = $pageno - 1;
                            $next = $pageno + 1;
                            $no_of_records_per_page = 200;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $pages = ceil($total/$no_of_records_per_page);

                            echo "<h5>Add more: </h5>";
                            $sql = "SELECT DISTINCT tagname FROM tagdetails GROUP BY tagname ORDER BY tagname ASC LIMIT $offset, $no_of_records_per_page";
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
                                    <label class = 'checkbox-inline'>
                                        <input type = 'checkbox' name = 'check_list[]' value = '$row[tagname]'>
                                        $row[tagname] ($count)&nbsp&nbsp&nbsp&nbsp&nbsp
                                    </label>
                                ";
                            }

                            if ($total > $no_of_records_per_page){
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
                            }
                        }catch(PDOException $e){
                            echo "An error occured. " .$e;
                        }
                    ?>
                <br />
                <input type = "submit" name = "tagsubmit" value = "SET" class = "btn btn-primary"><br /><br />
                </form>
                <hr />
            </div>
            <?php echo $_SERVER['SERVER_NAME']; ?>
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h5>Active Tags</h5>
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