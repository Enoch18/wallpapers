<?php
include ('session.php');
include ('inc.php');
include ('../database/connection.php');
require '../mailer/phpmailer/PHPMailerAutoload.php';

$sent = '';
$fail = '';

if(isset($_POST['submit']) && $_POST['subject'] != '' && $_POST['message'] != ''){
    try{
        $sql = "SELECT * FROM subscribers";
        $result = $pdo->query($sql);
        while($row = $result->fetch()){
            $email = $row['email'];
            $id = $row['id'];
            $message = $_POST['message'];
            $subject = $_POST['subject'];

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail ->SMTPDebug = 4;
            $mail->Host = "smtpout.secureserver.net";
            $mail->SMTPAuth = true;
            $mail->Port = 80;
            $mail->Username = "admin@downloadallwallpapers.com";
            $mail->Password = "Download.1";
            //$mail->SMTPSecure = 'ssl';
            $mail->SetFrom('admin@downloadallwallpapers.com', "Download All Wallpapers");
            $mail->addAddress($email, "");
            $mail->AddReplyTo("admin@downloadallwallpapers.com", "");

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->IsHtml(true);
            //$mail->AddEmbeddedImage("http://www.downloadallwallpapers.com/ssgrouplogin/images/936895371559168578Dogs%202.jpg", "image1");
            $mail->Subject = $subject;
            $mail->Body = "
                <div style = 'background-color: rgb(75, 74, 74); width: 100%;'>
                    <img src = 'http://www.downloadallwallpapers.com/icons/website%20banner.jpg' class = 'img img-responsive' style = 'width: 100%'>
                </div>
                <div style = 'background-color: white; width: 100%;'>
                    <p style = 'color: black; font-size: 20px;'>$message</p><br />
                        <div class = 'row'>";

                            foreach ($_POST['images'] as $images){
                                $data = explode("____", $images);
                                $images = $data[0];
                                $imagename = str_replace(" ", "_", $data[1]);
                                $id = $data[2];

                                $mail->Body .= "
                                <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                    <a href = 'http://www.downloadallwallpapers.com/download.php?value=$imagename-$id'>
                                        <img src = '$images' style = 'width: 100%'>
                                    </a>
                                </div>";
                            }

                        $mail->Body .= "
                        </div>
                    <p style = 'font-size: 20px;'>You are receiving this message because you have subscribed to www.downloadallwallpapers.com 
                    To no longer receive messages from us, click
                    <a href = 'http://www.downloadallwallpapers.com/unsubscribe.php?id=$id'>Unsubscribe</a></p><br />
                </div>";

            $mail->AltBody = $message;
            if(!$mail->send()) {
                
            } else {
                $_SESSION['sent'] = 'News letters have been sent';
                $sent = $_SESSION['sent'];
            }

            $mail->clearAddresses();
            $mail->clearAttachments();
        }
    }catch(PDOException $e){
        echo "Error ".$e;
    }
}else{
    $_SESSION['fail'] = "Could not send, no wallpapers were uploaded yesterday";
}
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>

    <div class = "container">
        <form action = "" method = "post" enctype = "multipart/form-data">
                <h2 style = "margin-top: 10%;">NEWS LETTER</h2>
                <?php if ($sent != '')echo "<p style = 'background-color: green; color: white;'>$_SESSION[sent]</p>"; unset($_SESSION['sent']); ?>
                <?php if ($fail != '')echo "<p style = 'background-color: red; color: white;'>$_SESSION[fail]</p>"; unset($_SESSION['fail']); ?>
                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Subject</label>
                    </div>

                    <div class = "col-lg-12 form-group">
                        <input type = "text" name = "subject" value = "Latest Wallpapers" class = "form-control" placeholder = "Subject">
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -20px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Message</label>
                    </div>

                    <div class = "col-lg-12 form-group">
                        <textarea name = "message" class = "form-control" maxlength = 300 rows = 3>Check out our latest wallpapers that were uploaded yesterday.</textarea>
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Choose Wallpapers from yesterday's upload</label>
                    </div>
                    <div class = "col-lg-12 form-group">
                        <div class = "row">
                            <?php
                                try{
                                    $date = date('Y-m-d');
                                    $yesterday = date('Y-m-d 00:01:01', strtotime($date. ' - 1 day'));
                                    $today = date('Y-m-d 23:59:00', strtotime($date. ' - 1 day'));
                                    $images = array();

                                    $sql = "SELECT * FROM resolutions AS r, details AS d
                                    WHERE width = '1920' AND height = '1080'
                                    AND d.d_id = r.d_id 
                                    ORDER BY r.createdat DESC
                                    LIMIT 30";
                                    $result = $pdo->query($sql);
                                    while($row = $result->fetch()){
                                        if($row['url'] != ''){
                                        echo "<div class = 'col-xs-12 col-sm-12 col-md-4 col-lg-3'>";
                                            echo "<label class = 'checkbox-inline'>
                                                <img src = '$row[url]'class = 'img img-responsive' style = 'width: 100%; cursor: pointer;'>
                                                <input type = 'checkbox' name = 'images[]' value = '$row[url]____$row[tag]____$row[d_id]' style = 'float: right; height: 20px; width: 20px; margin-top: 1%;'><br /><br /><br />
                                            </label>
                                        </div>";
                                        }else{
                                            echo "<h4 style = 'text-align: center;'>No wallpapers were uploaded yesterday</h4>";
                                        }
                                    } 
                                    }catch(PDOException $e){
                                        echo "An error occured. " .$e;
                                }
                            ?>
                        </div>
                    </div>
                </div>

            <div class = "row">
                <div class = "col-lg-12">
                    <input type = "submit" name = "submit" class = "btn btn-primary pull-left" value = "Send" style = "height:50px; width:200px; font-size:25px; margin-top: -30px;">
                </div><br /><br />
            </div>
        </form>
    </div>

</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $('input[type=checkbox]').click(function(){
            var totalnum = $(":checkbox:checked").length;
            if(totalnum >= 10){
                $('input[type=checkbox]').not(':checked').attr('disabled', true);
            }else{
                $('input[type=checkbox]').attr('disabled', false);
            }
        });
    });
</script>
<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});
</script>

</body>
</html>