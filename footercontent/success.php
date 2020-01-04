<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message Sent</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src = "../assets/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <link href="../assets/css/global.css" rel="stylesheet">
    <link href="../assets/css/stylesheet.css" rel="stylesheet">
    <link href="../assets/css/responsiveness.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        p{
            font-size: 20px;
        }

        h4{
            font-family: Arial !important;
        }

        @media (max-width: 767px){
            p{
                font-size: 16px;
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
    <!-- Beginning of code for the Privacy content -->
    <div class = "container" style = "color: white; text-align: center; height: 400px;">
        <p style = "margin-top: 7%;">Thank You for contacting Us. One of our customer support executives</p><p>will get in touch with you soon.<p>
    </div>
    <!-- End of code for the Privacy content -->
    <?php include ('footer.php'); ?>
</body>