<!DOCTYPE html>
<html lang="en">
<head>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-8918135732106370",
          enable_page_level_ads: true
     });
</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download All Wallpapers</title>
    <link rel="shortcut icon" href = "icons/ico.ico">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src = "assets/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href="assets/css/global.css" rel="stylesheet">
    <link href="assets/css/stylesheet.css" rel="stylesheet">
    <link href="assets/css/responsiveness.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<?php
    include ('database/connection.php');
    include ('navbar.php');
    $email = $_GET['email'];
    if($email != ''){
        echo "
        <div style = 'color: white; margin-top: 5%; text-align: center; font-size: 20px;'>
            <p>We are sad to see that you have unsubscribed.</p> <p>Feel free to subscribe again at anytime when you want to.</p>
        </div>
        ";
        try{
            $sql = "INSERT INTO unsubscribers SET
            email = :email,
            timestamp = :timestamp";
            $s = $pdo->prepare($sql);
            $s->bindValue(':email', $email);
            $s->bindValue(':timestamp', date('Y-m-d H:i:s'));
            $s->execute();
        }catch(PDOException $e){
            echo "An error occured ". $e;
        }

        $sql = "DELETE FROM subscribers WHERE email = '$email'";
        $pdo->exec($sql);
    }
?>
</body>
</html>