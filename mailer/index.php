<?php
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->IsSMTP();
$mail -> SMTPDebug = 1;
$mail->Host = "smtpout.secureserver.net";
$mail->SMTPAuth = true;
$mail->Port = 80;
$mail->Username = "admin@downloadallwallpapers.com";
$mail->Password = "Download.1";
//$mail->SMTPSecure = 'ssl';
$mail->SetFrom('admin@downloadallwallpapers.com', 'DownloadAllWallpapers');
$mail->addAddress('sokoenock@gmail.com', 'Enock User');
$mail->AddReplyTo("admin@downloadallwallpapers.com","Cagney");

$mail->isHTML(true);                                  // Set email format to HTML

$mail->IsHtml(true);
$mail->Subject = 'Here is the subject';
$mail->Body = "<div style = 'background-color: rgb(150, 19, 150); height: 500px; width: 550px;'>
                    <h1 style = 'color: rgb(173, 141, 194); background-color: rgb(23, 7, 44); padding-left: 10%; height: 70px; padding-top: 5px;'>Travelowood</h1>
                    <br /><p style = 'color: white; padding-left: 10%; width: 500px;'>Dear, <br />Thank you for choosing Travelowood, we assure you that you will 
                    not be disappointed by our services. Our primary goal is to make sure that you have the best services. Our experts have a lot of experience, 
                    and they will find the lowest prices for you. <br /></p><br />
                </div>";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>