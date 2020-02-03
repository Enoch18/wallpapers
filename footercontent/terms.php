<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Terms and Conditions</title>
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
        <h3 style = "color:white; text-align: center; text-decoration: underline;">TERMS OF SERVICE</h3>
        <p>
        This document outlines what constitutes acceptable use of the IncredibleWallpapers, it's associated web services, and server infrastructure. It also 
        covers our content moderation policy and what you can expect regarding performance and availability.<br /><br />
        By using IncredibleWallpapers, you acknowledge and agree to the terms and conditions of this IncredibleWallpapers Terms of Service Statement 
        ("<a href = "">Terms of Service</a>"). If you do not agree to these terms and conditions, please do not use this website.
        </p><br />

        <h4 style = "text-decoration: underline;">Access</h4>
        <p>This web site is intended to be accessed via standard web browser and similar products via direct interaction by a human. With the exception of 
        publicly accessible RSS feeds provided in XML format, the web site, and its associated files are not meant to be accessed via any automated means 
        such as by scripts or bots or automated applications.</p>
        <p>Be aware that if you utilize an automated means of accessing or downloading this web site, in whole or in part, your access to the site may be 
        prevented, terminated, delayed, or slowed either temporarily or permanently, especially if you attempt to download too many large files simultaneously. 
        <p>This is necessary in order to protect the user experience of the IncredibleWallpapers for those who access it in the manner envisioned by its authors.</p>
        <p>Please understand that automated access to the site, via scripts, bots, or other similar means can have the effect of seriously degrading the performance 
        of the web site or incurring significant additional costs to its operators without sufficient revenue generated to cover those costs. Keep in mind, 
        that even minor infractions against this policy can have a large negative effect when combined with similar actions by other users.</p>
        <p>We ask that you respect the above guidelines so that we may continue to offer the IncredibleWallpapers as a free resource to the world. We prefer 
        to use our resources, both human and financial, to improve and expand the features and content of the web site. Your cooperation is essential.</p><br />

        <h4 style = "text-decoration: underline;">Linking</h4>
        <p>Direct hyperlinking to images and other large files hosted by IncredibleWallpapers is strictly prohibited without our permission. You may of course 
        link directly to individual HTML or XML based web pages. Direct linking to our small preview images is permitted but not guaranteed.</p>
        <p>With the exception of publicly available RSS feeds in XML format, no files or services hosted on this web site are to be integrated into any other 
        online service or application without the expressed written permission of the operators of this web site.</p><br />

        <h4 style = "text-decoration: underline;">Performance</h4>
        <p>The operators of the web site make a reasonable attempt to maintain the availability and performance of IncredibleWallpapers and its associated 
        services. However, uptime and accessibility cannot be guaranteed. The web site may occasionally be inaccessible, in whole or in part, due to planned 
        or emergency maintenance, feature upgrades, bug fixes, server migrations, hardware upgrades, and failures, or simply to prevent unauthorized use, hacking, 
        or exploitation of the web site, or its resources.</p><br />

        <h4 style = "text-decoration: underline;">Liability</h4>
        <p>IncredibleWallpapers, its owners, employees, contractors, and partners shall not be held legally liable or financially responsible for any loss, damage, 
        or injury incurred as a result of the use or existence of IncredibleWallpapers, its associated sites, content, services or infrastructure.</p>
        <p>That being said, if you have any concerns about the web site, please make them known to the operators via <a href = "contact.php">Contact us</a> link.</p><br /><br />
    </div>
    <!-- End of code for the Privacy content -->
    <?php include ('footer.php'); ?>
</body>