<?php
include ('../database/connection.php');
require '../mailer/phpmailer/PHPMailerAutoload.php';
include ('../config.php');
//error_reporting(0);
session_start();
$evalutation = '';
$notfound = '';
$sent = '';

if(isset($_POST['submit'])){
    $temppass = rand(20000, 80000);
    $pass = md5($temppass . 'ijdb');
    $sql = "SELECT * FROM admin";
    $result = $pdo->query($sql);

    while ($row = $result->fetch()){
        $id = $row['id'];
        $cemail = $row['email'];
        $password = $row['password'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        
        if($cemail == $_POST['email']){
            
            try{
                $sql = "UPDATE admin SET
                passwordconfirmation = :passwordconfirmation
                WHERE email = '$cemail'";
                $s = $pdo->prepare($sql);
                $s->bindValue(':passwordconfirmation', $pass);
                $s->execute();
            }catch(PDOException $e){
                echo "Failed to add the image!!!" . $e;
            }

            //Code for sending the temporary password email
            $mail = new PHPMailer;
            //$mail->SMTPDebug = 4;                               // Enable verbose debug output
            $mail->isSMTP();                                    // Set mailer to use SMTP
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->Host = 'mail.privateemail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $email;                 // SMTP username
            $mail->Password = $emailpassword;                    // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom($email, $name);
            $mail->addAddress($cemail, '');     // Add a recipient
            $mail->addReplyTo($email);

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->IsHtml(true);
            $mail->Subject = "Temporary Password";
            $message = "Hi $firstname, login with the temporary password: $temppass";
            $mail->Body = "<div style = 'background-color: white; height: 500px; width: 550px; border-radius: 1px solid gray;'>
                                <h1 style = 'color: black; background-color: white; padding-left: 10%; height: 70px; padding-top: 5px;'>$name</h1>
                                <br /><p style = 'color: black; padding-left: 10%; width: 500px;'>$message<br /></p><br />
                            </div>";
            $mail->AltBody = '';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
            $sent = "Login with the password that has been sent to the email you entered and change your password.";
        }else{
            $notfound = "That email was not found in the system!!!!";
        }
    }
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

<nav class="navbar navbar-expand-lg navbar-light bg-light" style = "background-color: rgb(19, 18, 18) !important;">
    <img src = "../icons/website banner.jpg" class = "img-responsive" style = "width: 100%; height: 80px; margin-top: 5px;">
</nav>
<body style = "background-color: rgb(19, 18, 18); margin-top: -10px;">
    <div class = "container">
        <div id = "login" style = "margin-top: 10% !important;">
            <h4 style = "color: white;">FORGOT PASSWORD</h4>
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12" style = "background-color:green; color:white; font-weight: bold; margin-bottom: -2%; margin-top: 1%;"><?php if ($sent != '')echo $sent ?></div><br /><br />
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12" style = "background-color:red; color:white; font-weight: bold; margin-bottom: -2%; margin-top: 1%;"><?php if ($notfound != '')echo $notfound ?></div><br /><br />
            <div class = "col-xs-12">
            <form class = "form-group" action = "" method = "POST">
                <label style = "color:white; text-align:left"><h5 style = "text-align:left">Enter your Email</h5></label>
                <div class="input-control"><i class="fas fa-envelope"></i>
					<input type="email" name = "email" placeholder="Email" class = "form-control"/>
				</div><br />
                <input type = "submit" name = "submit" class = "form-control btn btn-primary" value = "Submit" style = "font-size: 20px; font-weight: bold; height: 50px;">
            </form>
        </div>
    </div>
</body>