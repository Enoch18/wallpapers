<?php
include ('session.php');
include_once ('../database/connection.php');
include ('inc.php');

if (isset($_POST['submit'])){
    try{
            $sql = "UPDATE customizations SET
            backgroundcolor = :backgroundcolor
            WHERE name = 'website'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':backgroundcolor', $_POST['webbackgroundcolor']);
            $s->execute();

            $sql = "UPDATE customizations SET
            textcolor = :textcolor
            WHERE name = 'website'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':textcolor', $_POST['webtextcolor']);
            $s->execute();

            $sql = "UPDATE customizations SET
            fontsize = :fontsize
            WHERE name = 'website'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':fontsize', $_POST['webfontsize']);
            $s->execute();

        // Buttons
            $sql = "UPDATE customizations SET
            backgroundcolor = :backgroundcolor
            WHERE name = 'buttons'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':backgroundcolor', $_POST['buttonsbackgroundcolor']);
            $s->execute();

            $sql = "UPDATE customizations SET
            textcolor = :textcolor
            WHERE name = 'buttons'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':textcolor', $_POST['buttonstextcolor']);
            $s->execute();

            $sql = "UPDATE customizations SET
            fontsize = :fontsize
            WHERE name = 'buttons'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':fontsize', $_POST['buttonsfontsize']);
            $s->execute();

            $sql = "UPDATE customizations SET
            bordercolor = :bordercolor
            WHERE name = 'buttons'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':bordercolor', $_POST['buttonbordercolor']);
            $s->execute();

        // Headings 
            $sql = "UPDATE customizations SET
            backgroundcolor = :backgroundcolor
            WHERE name = 'headings'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':backgroundcolor', $_POST['headingsbackgroundcolor']);
            $s->execute();

            $sql = "UPDATE customizations SET
            textcolor = :textcolor
            WHERE name = 'headings'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':textcolor', $_POST['headingstextcolor']);
            $s->execute();

            $sql = "UPDATE customizations SET
            fontsize = :fontsize
            WHERE name = 'buttons'";
            $s = $pdo->prepare($sql);
            $s->bindValue(':fontsize', $_POST['buttonsfontsize']);
            $s->execute();

             // Marquee 
             $sql = "UPDATE customizations SET
             backgroundcolor = :backgroundcolor
             WHERE name = 'marquee'";
             $s = $pdo->prepare($sql);
             $s->bindValue(':backgroundcolor', $_POST['marqueebackgroundcolor']);
             $s->execute();
 
             $sql = "UPDATE customizations SET
             textcolor = :textcolor
             WHERE name = 'marquee'";
             $s = $pdo->prepare($sql);
             $s->bindValue(':textcolor', $_POST['marqueetextcolor']);
             $s->execute();
 
             $sql = "UPDATE customizations SET
             description = :description
             WHERE name = 'marquee'";
             $s = $pdo->prepare($sql);
             $s->bindValue(':description', $_POST['marqueedescription']);
             $s->execute();

             $sql = "UPDATE customizations SET
             textcolor = :textcolor
             WHERE name = 'tagletters'";
             $s = $pdo->prepare($sql);
             $s->bindValue(':textcolor', $_POST['tagletterstextcolor']);
             $s->execute();
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
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
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

                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
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

                                <p>Border Color: $row[bordercolor]</p>
                                <input type = 'text' name = 'buttonbordercolor' value = '$row[bordercolor]' class = 'form-control edit'><br />
                            ";
                        }
                    ?>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <h4>Marquee Customization</h4>
                    <?php 
                        $sql = "SELECT * FROM customizations WHERE name = 'marquee'";
                        $result = $pdo->query($sql);
                        while ($row = $result->fetch()){
                            echo "
                                <p>Background Color: $row[backgroundcolor]</p>
                                <input type = 'text' name = 'marqueebackgroundcolor' value = '$row[backgroundcolor]' class = 'form-control edit'><br />

                                <p>Text Color: $row[textcolor]</p>
                                <input type = 'text' name = 'marqueetextcolor' value = '$row[textcolor]' class = 'form-control edit'><br />

                                <p>Website Marquee</p>
                                <textarea name = 'marqueedescription' value = 'description' class = 'form-control'>$row[description]</textarea><br />
                            ";
                        }
                    ?>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
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

                        $sql = "SELECT * FROM customizations WHERE name = 'tagletters'";
                        $result = $pdo->query($sql);
                        while ($row = $result->fetch()){
                            echo "
                                <p><b>Active Tags Letter Color:</b> $row[textcolor]</p>
                                <input type = 'text' name = 'tagletterstextcolor' value = '$row[textcolor]' class = 'form-control edit'><br />
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