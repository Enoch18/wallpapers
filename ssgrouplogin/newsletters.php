<?php
include ('session.php');
include ('inc.php');
include ('../database/connection.php');
require '../mailer/phpmailer/PHPMailerAutoload.php';

$sent = '';
$fail = '';

$server = $_SERVER['SERVER_NAME'];
if ($_SERVER['SERVER_NAME'] == 'localhost'){
    $server = "http://" . $_SERVER['SERVER_NAME'] . "/wallpapers";
}else{
    "http://" . $_SERVER['SERVER_NAME'];
}

if(isset($_POST['submit']) && $_POST['subject'] != '' && $_POST['message'] != ''){
    if ($_POST['subscribers'] != ''){
        $message = $_POST['message'];
        $subject = $_POST['subject'];

        foreach ($_POST['subscribers'] as $email){
            $mail = new PHPMailer;
            $mail->IsSMTP();
            //$mail ->SMTPDebug = 4;
            $mail->Host = "smtpout.secureserver.net";
            $mail->SMTPAuth = true;
            $mail->Port = 80;
            $mail->Username = "admin@downloadallwallpapers.com";
            $mail->Password = "Sabir@Groups@88";
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
                    <img src = '$server/icons/banner.jpg' class = 'img img-responsive' style = 'width: 100%'>
                </div>
                <div style = 'background-color: white; width: 100%;'>
                    <p style = 'color: black; font-size: 20px;'>$message</p><br />
                        <div class = 'row'>";

                        foreach ($_POST['images'] as $images){
                            $data = explode("____", $images);
                            $images = $data[0];
                            $images = str_replace("../", "", $images);
                            $imagename = $data[1];

                            $mail->Body .= "
                            <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                <a href = '$server/download.php?value=$imagename'>
                                    <img src = '$server/$images' style = 'width: 100%'>
                                </a>
                            </div>";
                        }

                        if ($_POST['wallpaper_url'] != ''){
                            $wallpaper_url = $_POST['wallpaper_url'];
                            $explode = explode(",", $wallpaper_url);
                            foreach ($explode as $image_url){
                                $link_explode = explode("=", $image_url);
                                $filestore = $link_explode[1] . "_500X281_www.incrediblewallpapers.com";
                                try{
                                    $sql = "SELECT * FROM resolutions AS r, details AS d
                                    WHERE r.filestore = '$filestore'
                                    AND d.d_id = r.d_id";
                                    $result = $pdo->query($sql);
                                    while($row = $result->fetch()){
                                        $original_filename = $row['original_filename'];
                                        $images = str_replace("../", "", $row['url']);
                                        $mail->Body .= "
                                        <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                            <a href = '$server/download.php?value=$original_filename'>
                                                <img src = '$server/$images' style = 'width: 100%'>
                                            </a>
                                        </div>";
                                    } 
                                }catch(PDOException $e){
                                    echo "An error occured. " .$e;
                                }
                            }
                        }

                        $mail->Body .= "
                        </div>
                    <p style = 'font-size: 20px;'>You are receiving this message because you have subscribed to www.incrediblewallpapers.com 
                    To no longer receive messages from us, click
                    <a href = '$server/unsubscribe.php?email=$email'>Unsubscribe</a></p><br />
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
    }

    if ($_POST['subscribers'] == ''){
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
                $mail->Password = "Sabir@Groups@88";
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
                        <img src = '$server/icons/banner.jpg' class = 'img img-responsive' style = 'width: 100%'>
                    </div>
                    <div style = 'background-color: white; width: 100%;'>
                        <p style = 'color: black; font-size: 20px;'>$message</p><br />
                            <div class = 'row'>";

                                foreach ($_POST['images'] as $images){
                                    $data = explode("____", $images);
                                    $images = $data[0];
                                    $images = str_replace("../", "", $images);
                                    $imagename = $data[1];

                                    $mail->Body .= "
                                    <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                        <a href = '$server/download.php?value=$imagename'>
                                            <img src = '$server/$images' style = 'width: 100%'>
                                        </a>
                                    </div>";
                                }

                                if ($_POST['wallpaper_url'] != ''){
                                    $wallpaper_url = $_POST['wallpaper_url'];
                                    $explode = explode(",", $wallpaper_url);
                                    foreach ($explode as $image_url){
                                        $link_explode = explode("=", $image_url);
                                        $filestore = $link_explode[1] . "_500X281_www.incrediblewallpapers.com";
                                        try{
                                            $sql = "SELECT * FROM resolutions AS r, details AS d
                                            WHERE r.filestore = '$filestore'
                                            AND d.d_id = r.d_id";
                                            $result = $pdo->query($sql);
                                            while($row = $result->fetch()){
                                                $original_filename = $row['original_filename'];
                                                $images = $row['url'];
                                                $mail->Body .= "
                                                <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                                    <a href = '$server/download.php?value=$original_filename'>
                                                        <img src = '$server/$images' style = 'width: 100%'>
                                                    </a>
                                                </div>";
                                            } 
                                        }catch(PDOException $e){
                                            echo "An error occured. " .$e;
                                        }
                                    }
                                }

                            $mail->Body .= "
                            </div>
                        <p style = 'font-size: 20px;'>You are receiving this message because you have subscribed to www.incrediblewallpapers.com
                        To no longer receive messages from us, click
                        <a href = '$server/unsubscribe.php?email=$email'>Unsubscribe</a></p><br />
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
    }
}else{
    $_SESSION['fail'] = "Could not send, no wallpapers were uploaded yesterday";
}
?>

<style>
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    margin-left: auto;
    margin-right: auto;
}

    /* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 768px;
}

@media (max-width: 767px){
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 500px;
    }
}
</style>

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
                        <input type = "text" name = "subject" value = "Latest Wallpapers" id = "subject" class = "form-control" placeholder = "Subject">
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Wallpaper Link (Seperate Multiple links with comma)</label>
                    </div>

                    <div class = "col-lg-12 form-group">
                        <input type = "text" name = "wallpaper_url" id = "subject" class = "form-control" placeholder = "Wallpaper Url">
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px; margin-top: -20px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Message</label>
                    </div>

                    <div class = "col-lg-12 form-group">
                        <textarea name = "message" class = "form-control" id = "message" maxlength = 300 rows = 3>Check out our latest wallpapers that were uploaded yesterday.</textarea>
                    </div>
                </div>

                <div class = "receipients" style = "display: none; max-height: 300px; overflow: auto;">
                    <h6>Choose Receipients</h6>
                    <input type = "checkbox" id = "checkall"> <label for = "checkall" style = "text-decoration: underline; cursor: pointer;"> Check All</label> <br />
                    <?php 
                        try{
                            $sql = "SELECT * FROM subscribers ORDER BY timestamp DESC";
                            $result = $pdo->query($sql);
                            while ($row = $result->fetch()){
                                echo "<input type = 'checkbox' name = 'subscribers[]' value = '$row[email]' class = 'receipientcheckbox'> " . $row['email'] . "&nbsp;";
                            }
                        }catch(PDOException $e){
                            echo "An error occured. " .$e;
                        }
                    ?>
                </div>

                <a href = "#" id = "addreceipients">Click here to choose Receipients</a>

                <div class = "row">
                    <div class = "col-lg-12" style = "margin-left:10px;">
                        <label style = "font-weight: bold; margin-left: -10px;">Choose Previously Uploaded Wallpapers</label>
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
                                    WHERE width = '500' AND height = '281' AND d.createdat BETWEEN '$yesterday' AND '$today'
                                    AND d.d_id = r.d_id 
                                    ORDER BY r.createdat DESC
                                    LIMIT 30";
                                    $result = $pdo->query($sql);
                                    while($row = $result->fetch()){
                                        if($row['url'] != ''){
                                        echo "<div class = 'col-xs-12 col-sm-12 col-md-4 col-lg-3'>";
                                            echo "<label class = 'checkbox-inline'>
                                                <img src = '$row[url]'class = 'img img-responsive' style = 'width: 100%; cursor: pointer;'>
                                                <input type = 'checkbox' name = 'images[]' class = 'images' value = '$row[url]____$row[tag]' style = 'float: right; height: 20px; width: 20px; margin-top: 1%;'><br /><br /><br />
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
                    <a class = "btn btn-primary" id = "prebtn" style = "color: white;">Submit</a>
                </div><br /><br />
            </div>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <div class = "modal-header">
                        <h4 class = "modal-title" style = "color: black !important;">Newsletter Preview</h4>
                        <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                    </div><br />
                
                    <div>
                        <p id = "prevsubject" style = "display:none;"><b>Subject: </b><span id = "prevsubdet"></span></p>
                        <p id = "prevmessage" style = "display:none;"><b>Message: </b><span id = "prevmesdet"></span></p>
                        <div id = "selectedimages"></div>
                        <input type = "submit" name = "submit" class = "btn btn-success pull-left" value = "Send" style = "height:50px; width:200px; font-size:25px;">
                    </div>
                </div>
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
    var modal = document.getElementById("myModal");
    $(document).ready(function(){
        $('input[type=checkbox]').click(function(){
            var totalnum = $(":checkbox:checked").length;
            if(totalnum >= 10){
                $('input[type=checkbox]').not(':checked').attr('disabled', true);
            }else{
                $('input[type=checkbox]').attr('disabled', false);
            }
        });

        $("#prebtn").click(function(){
            modal.style.display = "block";
            $("#prevsubject").show();
            let subject = $("#subject").val();
            $("#prevsubdet").html(subject);

            $("#prevmessage").show();
            let message = $("#message").val();
            $("#prevmesdet").html(message);

            let images = [];
            $.each($(".images:checked"), function(){
                images.push($(this).val());
            });

            for (var i = 0; i < images.length; ++i){
                $("#selectedimages").append("<div style = 'width: 100%'><img src = '" + images[i].split('___')[0] +"' style = 'width: 100%;'> </div><br />")
            }
        });

        $(".close").click(function(){
            $(".modal").css({
                display: 'none'
            });
        });

        $("#addreceipients").click(function(e){
            e.preventDefault();
            $(".receipients").show();
            $("#addreceipients").hide();
        });

        $("#checkall").click(function(){
            $('.receipientcheckbox').not(this).prop('checked', this.checked);
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