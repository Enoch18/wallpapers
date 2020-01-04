<?php
require '../mailer/phpmailer/PHPMailerAutoload.php';
$status = '';
if(isset($_POST['submit'])){
    $fullname = $_POST['name'];
    $senderemail = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer;

    $mail->IsSMTP();
    //$mail ->SMTPDebug = 1;
    $mail->Host = "smtpout.secureserver.net";
    $mail->SMTPAuth = true;
    $mail->Port = 80;
    $mail->Username = "admin@downloadallwallpapers.com";
    $mail->Password = "Download.1";
    //$mail->SMTPSecure = 'ssl';
    $mail->SetFrom('admin@downloadallwallpapers.com', $fullname);
    $mail->addAddress('admin@downloadallwallpapers.com', $fullname);
    $mail->AddReplyTo($senderemail, $fullname);

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->IsHtml(true);
    $mail->Subject = 'New Message';
    $mail->Body = $message;
    $mail->AltBody = $message;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
    } else {
        header ("Location: success.php");
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="shortcut icon" href = "../icons/website banner.jpg">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src = "../assets/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <link href="../assets/css/global.css" rel="stylesheet">
    <link href="../assets/css/stylesheet.css" rel="stylesheet">
    <link href="../assets/css/responsiveness.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        #cont2{
            width: 65%;
        }
        @media (max-width: 767px){
            p{
                font-size: 16px;
            }
            #cont2{
                width: 100% !important;
            }
        }
    </style>
</head>

<script>
$(document).ready(function(){
    $('#subscribe').hide();
    $('#subbtn').click(function(){
        $('#subbtn').hide();
        $('#subscribe').show();
    })
})
</script>

<body>
    <div id = "color">
        <?php include ('nav.php'); ?>
    </div>
    <!-- Beginning of code for the Site Contact -->
        <div class = "container" style = "height: 700px !important; border: 2px solid white;">
            <div class = "container" id = "cont2">
                <h3 style = "color:gray; text-align: center; padding-top: 10%; color: white;">CONTACT US</h3>
                <div id = "contactus">
                <div class = "row">
                    <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12" style = "border: 1px solid gray; margin-right:">
                        <?php if($status != '') echo "<div style = 'background-color: green; color:white;'>$status</div>"; ?>
                        <h5 style = "color: white;">SEND US A MESSAGE</h5>
                        <div class = "col-xs-12">
                            <form class = "form-group" action = "" method = "POST">
                                <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for = "name"><b style = "margin-left: -15%; color: white">Full Name</b></label>
                                </div>
                                <input type = "text" name = "name" id = "name" class = "form-control" placeholder = "Full Name" required><br />

                                <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for = "email"><b style = "margin-left: -30%; color: white">Email</b></label>
                                </div>
                                <input type = "text" name = "email" id = "email" class = "form-control" placeholder = "Email" required><br />


                                <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for = "message"><b style = "margin-left: -25%; color: white">Message</b></label>
                                </div>
                                <textarea name = "message" id = "message" class = "form-control" rows = "5"></textarea><br />
                                <input type = "submit" name = "submit" class = "form-control btn btn-primary" value = "Send Now">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of code for the Site map Contact -->
    <?php include ('footer.php'); ?>
</body>