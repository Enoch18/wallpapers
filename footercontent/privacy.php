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
        <h3 style = "color:white; text-align: center; padding-top: 5%; text-decoration: underline;">PRIVACY</h3><br />
        <p>
        IncredibleWallpapers respects the privacy of all its visitors and any co-branded, mirrored, or successor sites (the "Website") and is committed to protecting their 
        privacy. The owners and operators of IncredibleWallpapers take your online privacy seriously. This document outlines the types of information collected by our servers 
        and provides links to the privacy policies of our third-party advertising partners.<br /><br />
        By using IncredibleWallpapers, you acknowledge and agree to the <a href = "terms.php">terms and conditions</a> of this IncredibleWallpapers Privacy Policy 
        Statement ("<a href = "">Privacy Policy</a>"). 
        If you do not agree to these terms and conditions, please do not use this website.<br /><br />
        We, IncredibleWallpapers, reserve the right to change or modify our privacy practices that are described herein from time to time simply by posting a revised 
        Privacy Policy on this Website. Any such change shall be effective immediately upon posting of the revised Privacy Policy on this Website. We reserve the right 
        to make the revised or changed Privacy Policy effective for information we already have about you, as well as any information we receive in the future. 
        We encourage you to refer to this Privacy Policy on an ongoing basis so that you understand our current privacy practices.</p><br />

        <h4 style = "text-decoration: underline;">Server Logs</h4>
        <p>Like most web sites, IncredibleWallpapers logs web, database, and other server-software usage and access information. This information may include your internet 
        protocol (IP) address, which in many cases can be translated to an affiliation (such as your work, school, or internet service provider), or a geographical 
        location. We only use this information for debugging purposes and for aggregating into anonymous usage and traffic statistics.</p><br />
        <h4 style = "text-decoration: underline;">Cookies</h4>
        <p>We use cookies to ensure that we give you the best experience on our website. If you continue to use IncredibleWallpapers, we will assume that you are happy 
        with it. While browsing IncredibleWallpapers , a small number of text files referred to as "cookies" are created on your local file system by your web browser 
        at the request of our servers. These files allow us to personalize the browsing experience for both registered and non-registered users. You are free to delete 
        them at any time or configure your browser not to create them. However, we do not guarantee that every feature of IncredibleWallpapers  will function as expected 
        without cookies enabled.</p><br />

        <h4 style = "text-decoration: underline;">Third-Party Advertisers</h4>
        <p>In order to cover the costs of providing IncredibleWallpapers as a free resource to the public, we have relationships with certain third-party advertising 
        networks. The practices of our advertising partners are not directly covered by IncredibleWallpapers's privacy policy. We recommend that you read their policies. 
        For your convenience, we provide a list of our advertising partners below. Unfortunately, we cannot guarantee it is always comprehensive and up to date.</p><br />

        <h4 style = "text-decoration: underline;">Google Adsense:</h4>
        <p>We present you the following information about Google and its terms for cookies.</p>
        <ul>
        <li style = "list-style-type: disc; margin-left: 20px;"><p>Third party vendors, including Google, use cookies to serve ads based on a user's prior visits to this website.</p></li>
        <li style = "list-style-type: disc; margin-left: 20px;"><p>Google's use of advertising cookies enables it and its partners to serve ads to our users based on their visit to our sites and/or other sites on the Internet.</p></li>
        <li style = "list-style-type: disc; margin-left: 20px;"><p>Users may opt out of personalized advertising by visiting Ads Settings. (Alternatively, you can opt out of a third-party vendor's use of cookies for personalized 
        advertising by visiting <a href = "http://www.aboutads.info" target = "_blank">www.aboutads.info</a>.)</p></li><br />
        </ul>

        <h4 style = "text-decoration: underline;">Sharing/Selling of Data</h4>
        <p>IncredibleWallpapers does NOT share or sell personally identifiable data to third parties such as direct marketers. We respect your privacy.</p><br />

        <h4 style = "text-decoration: underline;">Data Retention</h4>
        <p>The data submitted to and generated by IncredibleWallpapers may be copied to additional machines for redundancy and backup purposes.</p><br /><br />
    </div>
    <!-- End of code for the Privacy content -->
    <?php include ('footer.php'); ?>
</body>