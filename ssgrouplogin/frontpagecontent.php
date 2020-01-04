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

    <!-- Beginning of code for the Add image form -->
    <div class = "container">
        <h4 style = "text-align:center; margin-top: 5%;">CHOOSE WHAT SHOULD APPEAR ON YOUR FIRST PAGE</h4>
        <div class = "row">
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form action = "" method = "POST">
                    <?php
                        $del = '';
                        try{
                            echo "<h5>Selected: </h5>";
                            $sql = "SELECT DISTINCT cat_name, cat_id FROM category AS c, frontpage AS f WHERE c.cat_id = f.c_id";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                echo "
                                    <label class = 'checkbox-inline'>
                                        <input type = 'checkbox' name = 'check_list[]' value = '$row[cat_id]'>
                                        $row[cat_name]&nbsp&nbsp&nbsp&nbsp&nbsp
                                    </label>
                                ";
                                $del = 'Not Empty';
                            }
                            echo "<br />";
                            if($del != '') echo "<input type = 'submit' name = 'delete' value = 'REMOVE' class = 'btn btn-danger'><br /><br />";
                        }catch(PDOException $e){
                            echo "An error occured. " .$e;
                        }
                    ?>
                </form>
            </div>

            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form action = "" method = "post" enctype = "multipart/form-data">
                    <?php
                        try{
                            echo "<h5>Add more: </h5>";
                            $sql = "SELECT DISTINCT cat_name, cat_id FROM category";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                echo "
                                    <label class = 'checkbox-inline'>
                                        <input type = 'checkbox' name = 'check_list[]' value = '$row[cat_id]'>
                                        $row[cat_name]&nbsp&nbsp&nbsp&nbsp&nbsp
                                    </label>
                                ";
                            } 
                        }catch(PDOException $e){
                            echo "An error occured. " .$e;
                        }
                    ?>
                <br />
                <input type = "submit" name = "submit" value = "SET" class = "btn btn-primary"><br /><br />
                </form>
            </div>
        </div>

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
            </div>

            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form action = "" method = "post" enctype = "multipart/form-data">
                    <?php
                        try{
                            echo "<h5>Add more: </h5>";
                            $sql = "SELECT DISTINCT tagname FROM tagdetails AS tn, details AS d WHERE tn.d_id = d.d_id ORDER BY d.createdat DESC LIMIT 200";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch()){
                                echo "
                                    <label class = 'checkbox-inline'>
                                        <input type = 'checkbox' name = 'check_list[]' value = '$row[tagname]'>
                                        $row[tagname]&nbsp&nbsp&nbsp&nbsp&nbsp
                                    </label>
                                ";
                            }
                        }catch(PDOException $e){
                            echo "An error occured. " .$e;
                        }
                    ?>
                <br />
                <input type = "submit" name = "tagsubmit" value = "SET" class = "btn btn-primary"><br /><br />
                </form>
            </div>

            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <br /><br />
                <h5>Active Tags</h5>
                <?php
                    try{
                        $sql = "SELECT * FROM tagdetails AS td, tags AS t WHERE td.id = t.tag_id ORDER BY td.tagname ASC";
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