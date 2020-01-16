<?php
include ('session.php');
include_once ('../database/connection.php');
include ('inc.php');

if (isset($_POST['submit'])){
    try{
        if ($_POST['webbackgroundcolor'] != ''){
            $sql = "UPDATE customizations SET
            backgroundcolor = :backgroundcolor
            WHERE name = 'website'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':backgroundcolor', $_POST['webbackgroundcolor']);
            $s->execute();
        }

        if ($_POST['webtextcolor'] != ''){
            $sql = "UPDATE customizations SET
            textcolor = :textcolor
            WHERE name = 'website'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':textcolor', $_POST['webtextcolor']);
            $s->execute();
        }

        if ($_POST['webfontsize'] != ''){
            $sql = "UPDATE customizations SET
            fontsize = :fontsize
            WHERE name = 'website'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':fontsize', $_POST['webfontsize']);
            $s->execute();
        }

        // Buttons
        if ($_POST['buttonsbackgroundcolor'] != ''){
            $sql = "UPDATE customizations SET
            backgroundcolor = :backgroundcolor
            WHERE name = 'buttons'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':backgroundcolor', $_POST['buttonsbackgroundcolor']);
            $s->execute();
        }

        if ($_POST['buttonstextcolor'] != ''){
            $sql = "UPDATE customizations SET
            textcolor = :textcolor
            WHERE name = 'buttons'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':textcolor', $_POST['buttonstextcolor']);
            $s->execute();
        }

        if ($_POST['buttonsfontsize'] != ''){
            $sql = "UPDATE customizations SET
            fontsize = :fontsize
            WHERE name = 'buttons'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':fontsize', $_POST['buttonsfontsize']);
            $s->execute();
        }

        // Headings 
        if ($_POST['headingsbackgroundcolor'] != ''){
            $sql = "UPDATE customizations SET
            backgroundcolor = :backgroundcolor
            WHERE name = 'headings'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':backgroundcolor', $_POST['headingsbackgroundcolor']);
            $s->execute();
        }

        if ($_POST['headingstextcolor'] != ''){
            $sql = "UPDATE customizations SET
            textcolor = :textcolor
            WHERE name = 'headings'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':textcolor', $_POST['headingstextcolor']);
            $s->execute();
        }

        if ($_POST['buttonsfontsize'] != ''){
            $sql = "UPDATE customizations SET
            fontsize = :fontsize
            WHERE name = 'buttons'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':fontsize', $_POST['buttonsfontsize']);
            $s->execute();
        }
    }catch(PDOException $e){
        echo "Error ".$e;
    }
}
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

    <div class = "customization">
        <h4>CUSTOMIZE</h4>
        <form action="" method = "POST">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h4>Main Customization</h4>
                    <?php 
                        $sql = "SELECT * FROM customizations WHERE name = 'website'";
                        $result = $pdo->query($sql);
                        while ($row = $result->fetch()){
                            echo "
                                <p>Main Background Color: $row[backgroundcolor]</p>
                                <input type = 'text' name = 'webbackgroundcolor' value = '$row[backgroundcolor]' class = 'form-control edit'><br />

                                <p>Website Text Color: $row[textcolor]</p>
                                <input type = 'text' name = 'webtextcolor' value = '$row[textcolor]' class = 'form-control edit'><br />

                                <p>Website Text Font Size (Add 'px' at the end of the size): $row[fontsize]</p>
                                <input type = 'text' name = 'webfontsize' value = '$row[fontsize]' class = 'form-control edit'><br />
                            ";
                        }
                    ?>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h4>Buttons Customization</h4>
                    <?php 
                        $sql = "SELECT * FROM customizations WHERE name = 'buttons'";
                        $result = $pdo->query($sql);
                        while ($row = $result->fetch()){
                            echo "
                                <p>Background Color: $row[backgroundcolor]</p>
                                <input type = 'text' name = 'buttonsbackgroundcolor' value = '$row[backgroundcolor]' class = 'form-control edit'><br />

                                <p>Text Color: $row[textcolor]</p>
                                <input type = 'text' name = 'buttonstextcolor' value = '$row[textcolor]' class = 'form-control edit'><br />
                            ";
                        }
                    ?>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h4>Headings Customization</h4>
                    <?php 
                        $sql = "SELECT * FROM customizations WHERE name = 'headings'";
                        $result = $pdo->query($sql);
                        while ($row = $result->fetch()){
                            echo "
                                <p>Background Color: $row[backgroundcolor]</p>
                                <input type = 'text' name = 'headingsbackgroundcolor' value = '$row[backgroundcolor]' class = 'form-control edit'><br />

                                <p>Text Color: $row[textcolor]</p>
                                <input type = 'text' name = 'headingstextcolor' value = '$row[textcolor]' class = 'form-control edit'><br />
                            ";
                        }
                    ?>
                </div>
            </div>
            <input type = "submit" name = "submit" value = "Submit" class = "btn btn-success">
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