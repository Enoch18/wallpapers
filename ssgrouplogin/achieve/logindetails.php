<?php
error_reporting(0);
include ('session.php');
include ('inc.php');
include ('../database/connection.php');


if(isset($_POST['editdetails'])){
    $success = '';
    $failed = '';
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $npass = $_POST['newpassword'];
    $newpassword = md5($npass . 'ijdb');

    $opass = $_POST['confirm'];

    if($opass == $npass){
        if($firstname != ''){
        $sql = "UPDATE admin SET
        firstname = :firstname
        WHERE id = 1";
        $s = $pdo->prepare($sql);
        $s->bindValue(':firstname', $firstname);
        $s->execute();
        }

        if($lastname != ''){
            $sql = "UPDATE admin SET
            lastname = :lastname
            WHERE id = 1";
            $s = $pdo->prepare($sql);
            $s->bindValue(':lastname', $lastname);
            $s->execute();
        }

        if($email != ''){
            $sql = "UPDATE admin SET
            email = :email
            WHERE id = 1";
            $s = $pdo->prepare($sql);
            $s->bindValue(':email', $email);
            $s->execute();
        }

        if($npass != ''){
            $sql = "UPDATE admin SET
            password = :newpassword
            WHERE id = 1";
            $s = $pdo->prepare($sql);
            $s->bindValue(':newpassword', $newpassword);
            $s->execute();
        }
        $success = "Your details have been saved!";
    }else{
        $failed = "Details not saved. Your passwords did not match";
    }
}
?>
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>
    <div class = "container">
        <div class = "col-lg-12">
            <h4 style = "margin-top: 10%;">CHANGE LOGIN DETAILS </h4>
            <?php 
                if($success != '') 
                    echo "<p style = 'color: white; background-color: green'>$success</p>"; 
                if($failed != '') 
                    echo "<p style = 'color: white; background-color: red'>$failed</p>";
            ?>
            <br /><br />
        </div>

        <div class = "col-lg-12">
            <form class = "form-group" action = "" method = "POST">
                <input type = "text" name = "firstname" class = "form-control" placeholder = "First Name"><br />
                <input type = "text" name = "lastname" class = "form-control" placeholder = "Last Name"><br />
                <input type = "email" name = "email" class = "form-control" placeholder = "New Email"><br />
                <input type = "password" name = "newpassword" class = "form-control" placeholder = "New Password"><br />
                <input type = "password" name = "confirm" class = "form-control" placeholder = "Confirm Password"><br />
                <input type = "submit" name = "editdetails" class = "form-control btn btn-primary col-lg-3" value = "Update">
            </form>
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