<?php
error_reporting(0);
session_start();
?>

<style>
input[type="email"]{
    text-transform: lowercase !important;
}
</style>

<div class = "col-lg-2" id = "col1">
    <form class = "from-group" action = "" method = "POST">
        <a href="#" class = "btn btn-primary form-control" id = "subbtn" style = "background-color: rgb(73, 133, 204); border: 1px solid rgb(73, 133, 204);">Subscribe Here</a><br /><br />
        <div id = "subscribe" style = "margin-top: -30px !important;">
            <label style = "font-weight: bold; color: white;">Enter your email</label><br /><br />
            <input type = "email" name = "email" placeholder = "Email"><br /><br />
            <input type = "submit" name = "submit" class = "btn btn-primary" value = "Subscribe" style = "background-color: rgb(73, 133, 204); border: 1px solid rgb(73, 133, 204);"><br /><br />
        </div>
    </form>

    <div id = "bannerright">
        <p>Advertisement</p>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-8918135732106370",
                enable_page_level_ads: true
            });
        </script>
    </div><br />

    <div id = "bannerright">
        <p>Advertisement</p>
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-8918135732106370",
                enable_page_level_ads: true
            });
        </script>
    </div>
</div>