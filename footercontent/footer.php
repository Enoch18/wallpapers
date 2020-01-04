<style>
    #footer{
        font-size: 18px;
    }

    #footer a{
        color: white;
    }

    #footer a:hover{
        color: white;
        opacity: 0.7;
    }

    @media (max-width: 767px){
        #footer{
            font-size: 14px;
        }
    }
</style>

<div style = "background-color: rgb(75, 74, 74); margin-top: 30px; width: 100% !important;">
    <ul style = "margin-left: 0px; font-weight: bold; padding-top: 10px; padding-bottom: 10px; color:white; text-align: center;" id = "footer">
        <li style = "display: inline; padding-left: 25px;">&copy 2019<?php if (date("Y") != "2019") echo " - " .date("Y"); ?>, All rights reserved.</li><br />
        <li style = "display: inline; padding-left: 25px;"><a href = "disclaimer.php">Disclaimer</a></li>
        <li style = "display: inline; padding-left: 25px;"><a href = "privacy.php">Privacy Policy</a></li>
        <li style = "display: inline; padding-left: 25px;"><a href = "terms.php">Terms of Service</a></li>
        <li style = "display: inline; padding-left: 25px;"><a href = "site.php">Site Map</a></li>
        <li style = "display: inline; padding-left: 25px;"><a href = "contact.php">Contact Us</a></li>
    </ul>
</div>