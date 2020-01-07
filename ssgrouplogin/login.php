<?php
include ('../database/connection.php');
error_reporting(0);
session_start();
$evalutation = '';

if(isset($_POST['submit'])){
    $pass = md5($_POST['password'] . 'ijdb');
    $sql = "SELECT * FROM admin";
    $result = $pdo->query($sql);

    while ($row = $result->fetch()){
        $id = $row['user_id'];
        $email = $row['email'];
        $password = $row['password'];
        $temppass = $row['passwordconfirmation'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        
        if($email == $_POST['email'] && ($password == $pass || $temppass == $pass)){
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['admin'] = "admin";
            $_SESSION['password'] = $pass;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['login'] = "Logged in!!!";
            header("Location: index.php");
            exit();
        }
    }
    $evalutation = "Access Denied!!!!";
}
?>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src = "../jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <link href = "../view/stylesheet.css" rel = "stylesheet">
    

<style>
#login{
    margin-top: 5%;
    text-align: center;
    height: 800px;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style = "background-color: rgb(75, 74, 74) !important;">
    <div class = "container">
        <img src = "../icons/banner.jpg" class = "img-responsive" style = "width: 100%; height: 90px; margin-top: 5px;">
    </div>
</nav>
<body style = "background-color: rgb(75, 74, 74); margin-top: -10px;">
    <div class = "container">
        <div id = "login" style = "margin-top: 10% !important; max-width: 400px; margin-left: auto; margin-right: auto;">
            <h2 style = "color: white;">LOGIN</h2>
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12" style = "background-color:red; color:white; font-weight: bold; margin-bottom: -2%; margin-top: 1%;"><?php if ($evalutation != '')echo $evalutation ?></div><br /><br />
            <div class = "col-xs-12">
            <form class = "form-group" action = "" method = "POST">
                <div class="input-control"><i class="fas fa-envelope"></i>
                    <input type="email" name = "email" placeholder="Email" class = "form-control"/>
				</div><br />
                <input type = "password" name = "password" class = "form-control" placeholder = "Password"><br />
                <input type = "submit" name = "submit" class = "form-control btn btn-primary" value = "Login" style = "font-size: 20px; font-weight: bold; height: 50px;">
                <a href = "forgotpassword.php"><h5 style = "text-align: left !important;">Forgot Password</h5></a>
            </form>
        </div>
    </div>
</body>