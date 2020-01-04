<?php
include ('session.php');
include ('inc.php');
include ('../database/connection.php');
require '../mailer/phpmailer/PHPMailerAutoload.php';

$sent = '';
$fail = '';

$images1 = $_POST['images'][0];
$images2 = $_POST['images'][1];
$images3 = $_POST['images'][2];
$images4 = $_POST['images'][3];
$images5 = $_POST['images'][4];
$images6 = $_POST['images'][5];
$images7 = $_POST['images'][6];
$images8 = $_POST['images'][7];
$images9 = $_POST['images'][8];
$images10 = $_POST['images'][9];

$did1 = $_POST['images'][0];
$did2 = $_POST['images'][1];
$did3 = $_POST['images'][2];
$did4 = $_POST['images'][3];
$did5 = $_POST['images'][4];
$did6 = $_POST['images'][5];
$did7 = $_POST['images'][6];
$did8 = $_POST['images'][7];
$did9 = $_POST['images'][8];
$did10 = $_POST['images'][9];

$image1 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images1");
$image2 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images2");
$image3 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images3");
$image4 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images4");
$image5 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images5");
$image6 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images6");
$image7 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images7");
$image8 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images8");
$image9 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images9");
$image10 = str_replace(" ", "%20", "http://www.downloadallwallpapers.com/ssgrouplogin/$images10");


if($image1 != "http://www.downloadallwallpapers.com/ssgrouplogin/"){
    $image1 = "<img src = '$image1' class = 'img img-thumbnail img-responsive' style = 'width: 100%;'><br /><br />";
    $sql = "SELECT * FROM resolutions WHERE url = '$did1'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $did1 = $row['d_id'];
    }
}else{
    $image1 = " ";
}

if($image2 != "http://www.downloadallwallpapers.com/ssgrouplogin/"){
    $image2 = "<img src = '$image2' class = 'img img-thumbnail img-responsive' style = 'width: 100%;'><br /><br />";
    $sql = "SELECT * FROM resolutions WHERE url = '$did2'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $did2 = $row['d_id'];
    }
}else{
    $image2 = " ";
}

if($image3 != "http://www.downloadallwallpapers.com/ssgrouplogin/"){
    $image3 = "<img src = '$image3' class = 'img img-thumbnail img-responsive' style = 'width: 100%;'><br /><br />";
    $sql = "SELECT * FROM resolutions WHERE url = '$did3'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $did3 = $row['d_id'];
    }
}else{
    $image3 = " ";
}

if($image4 != "http://www.downloadallwallpapers.com/ssgrouplogin/"){
    $image4 = "<img src = '$image4' class = 'img img-thumbnail img-responsive' style = 'width: 100%;'><br /><br />";
    $sql = "SELECT * FROM resolutions WHERE url = '$did4'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $did4 = $row['d_id'];
    }
}else{
    $image4 = " ";
}

if($image5 != "http://www.downloadallwallpapers.com/ssgrouplogin/"){
    $image5 = "<img src = '$image5' class = 'img img-thumbnail img-responsive' style = 'width: 100%;'><br /><br />";
    $sql = "SELECT * FROM resolutions WHERE url = '$did5'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $did5 = $row['d_id'];
    }
}else{
    $image5 = " ";
}

if($image6 != "http://www.downloadallwallpapers.com/ssgrouplogin/"){
    $image6 = "<img src = '$image6' class = 'img img-thumbnail img-responsive' style = 'width: 100%;'><br /><br />";
    $sql = "SELECT * FROM resolutions WHERE url = '$did6'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $did6 = $row['d_id'];
    }
}else{
    $image6 = " ";
}

if($image7 != "http://www.downloadallwallpapers.com/ssgrouplogin/"){
    $image7 = "<img src = '$image7' class = 'img img-thumbnail img-responsive' style = 'width: 100%;'><br /><br />";
    $sql = "SELECT * FROM resolutions WHERE url = '$did7'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $did7 = $row['d_id'];
    }
}else{
    $image7 = " ";
}

if($image8 != "http://www.downloadallwallpapers.com/ssgrouplogin/"){
    $image8 = "<img src = '$image8' class = 'img img-thumbnail img-responsive' style = 'width: 100%;'><br /><br />";
    $sql = "SELECT * FROM resolutions WHERE url = '$did8'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $did8 = $row['d_id'];
    }
}else{
    $image8 = " ";
}

if($image9 != "http://www.downloadallwallpapers.com/ssgrouplogin/"){
    $image9 = "<img src = '$image9' class = 'img img-thumbnail img-responsive' style = 'width: 100%;'><br /><br />";
    $sql = "SELECT * FROM resolutions WHERE url = '$did9'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $did9 = $row['d_id'];
    }
}else{
    $image9 = " ";
}

if($image10 != "http://www.downloadallwallpapers.com/ssgrouplogin/"){
    $image10 = "<img src = '$image10' class = 'img img-thumbnail img-responsive' style = 'width: 100%;'><br /><br />";
    $sql = "SELECT * FROM resolutions WHERE url = '$did10'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
        $did10 = $row['d_id'];
    }
}else{
    $image10 = " ";
}

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
            //$mail ->SMTPDebug = 4;
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
                    <div class = 'row'>
                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <a href = 'http://www.downloadallwallpapers.com/download.php?id=$did1'>
                                $image1
                            </a>
                        </div>

                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                        <a href = 'http://www.downloadallwallpapers.com/download.php?id=$did2'>
                                $image2
                            </a>
                        </div>
                    
                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <a href = 'http://www.downloadallwallpapers.com/download.php?id=$did3'>
                                $image3
                            </a>
                        </div>

                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <a href = 'http://www.downloadallwallpapers.com/download.php?id=$did4'>
                                $image4
                            </a>
                        </div>

                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <a href = 'http://www.downloadallwallpapers.com/download.php?id=$did5'>
                                $image5
                            </a>
                        </div>

                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <a href = 'http://www.downloadallwallpapers.com/download.php?id=$did6'>
                                $image6
                            </a>
                        </div>

                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <a href = 'http://www.downloadallwallpapers.com/download.php?id=$did7'>
                                $image7
                            </a>
                        </div>

                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <a href = 'http://www.downloadallwallpapers.com/download.php?id=$did8'>
                                $image8
                            </a>
                        </div>

                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <a href = 'http://www.downloadallwallpapers.com/download.php?id=$did9'>
                                $image9
                            </a>
                        </div>

                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                            <a href = 'http://www.downloadallwallpapers.com/download.php?id=$did10'>
                                $image10
                            </a>
                        </div>
                    </div>
                    <p style = 'font-size: 20px;'>You are receiving this message because you have subscribed to www.downloadallwallpapers.com 
                    To no longer receive messages from us, click
                    <a href = 'http://www.downloadallwallpapers.com/unsubscribe.php?id=$id'>Unsubscribe</a></p><br />
            </div>
            ";
            $mail->AltBody = $message;

            if(!$mail->send()) {
                
            } else {
                $_SESSION['sent'] = 'News letters have been sent';
                $sent = $_SESSION['sent'];
            }
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
                        <input type = "text" name = "subject" class = "form-control" placeholder = "Subject">
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -20px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Message</label>
                    </div>

                    <div class = "col-lg-12 form-group">
                        <textarea name = "message" class = "form-control" maxlength = 300 rows = 3></textarea>
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

                                    $sql = "SELECT * FROM resolutions
                                    WHERE createdat BETWEEN '$yesterday' AND '$today'
                                    AND width = '1920' AND height = '1080' 
                                    ORDER BY createdat DESC
                                    LIMIT 30";
                                    $result = $pdo->query($sql);
                                    while($row = $result->fetch()){
                                        if($row['url'] != ''){
                                        echo "<div class = 'col-xs-12 col-sm-12 col-md-4 col-lg-3'>";
                                            echo "<label class = 'checkbox-inline'>
                                                <img src = '$row[url]'class = 'img img-responsive' style = 'width: 100%; cursor: pointer;'>
                                                <input type = 'checkbox' name = 'images[]' value = '$row[url]' style = 'float: right; height: 20px; width: 20px; margin-top: 1%;'><br /><br /><br />
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