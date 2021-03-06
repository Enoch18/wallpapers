<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Privacy</title>
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
    <div class = "container footercontent" style = "color: white; text-align: justify;">
        <h3 style = "color:white; text-align: center; padding-top: 5%; text-decoration: underline;">DISCLAIMER</h3><br />
        <p>
            IncredibleWallpapers is a user-friendly website and welcomes all its users to benefit from its content. However, using this website means you willingly agree 
            to all terms and conditions mentioned in our <a href = "terms.php">Terms of Service</a> and <a href = "privacy.php">Privacy Policy</a> pages. We strongly recommend 
            you to read these pages before using this website and its content.<br /><br />
            IncredibleWallpapers has no intention of violating anyone's copyright and takes the matter very seriously. If you are a copyright holder of a particular image, 
            please contact us about this using this <a href = "contact.php">Contact Us</a> form.  <br /><br />
            Although published content is believed to be authorized for sharing and personal use as desktop wallpaper unless otherwise noted in the wallpaper description, 
            all images on this website are copyrighted by IncredibleWallpapers, therefore, if you wish to use these images for any other use you must get permission from us 
            before doing so. Feel free to contact us using the <a href = "contact.php">Contact Us</a> form.  <br /><br />
            If you object to a wallpaper published on our site, please <a href = "contact.php">Contact us</a> with the wallpaper title or URL and your cause for concern, 
            whether it being your own wallpaper you've created and do not wish to share or may it be something you might find explicit, unethical, inappropriate, etc.
            If you’re the author of a specific wallpaper and want to be credited for it, please contact us using the <a href = "contact.php">Contact Us</a> form. We will verify your concern and add your credentials to the respective content.
        </p>
    </div><br /><br />
    <!-- End of code for the Privacy content -->
    <?php include ('footer.php'); ?>
</body>