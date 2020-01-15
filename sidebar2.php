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
            <!-- New horiznontal -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-8918135732106370"
                data-ad-slot="4329202681"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
    </div><br />

    <div class = "webstatistics">
        <h5>Website Statistics</h5>
        <?php 
            include ('database/connection.php');
            $totalwallpapers = '';
            $totaldownloads = '';
            $totalcategories = '';
            $totalsubcategories = '';
            $lastupload = '';
            $maxdid = '';

            try{
                $num = array();
                $sql = "SELECT * FROM details";
                $result = $pdo->query($sql);
                while ($row = $result->fetch()){
                    $num[] = $row['d_id'];
                }
                $maxdid = max($num);
                $totalwallpapers = count($num);
            }catch(PDOException $e){
                echo "Could not perform the operation ".$e;
            }

            try{
                $num = array();
                $sql = "SELECT * FROM downloads";
                $result = $pdo->query($sql);
                while ($row = $result->fetch()){
                    $num[] = $row['counter'];
                }
                $totaldownloads = array_sum($num);
            }catch(PDOException $e){
                echo "Could not perform the operation ".$e;
            }

            try{
                $num = array();
                $sql = "SELECT * FROM category";
                $result = $pdo->query($sql);
                while ($row = $result->fetch()){
                    $num[] = $row['cat_id'];
                }
                $totalcategories = count($num);
            }catch(PDOException $e){
                echo "Could not perform the operation ".$e;
            }

            try{
                $num = array();
                $sql = "SELECT * FROM subcategory";
                $result = $pdo->query($sql);
                while ($row = $result->fetch()){
                    $num[] = $row['sub_id'];
                }
                $totalsubcategories = count($num);
            }catch(PDOException $e){
                echo "Could not perform the operation ".$e;
            }

            try{
                $sql = "SELECT * FROM details WHERE d_id = '$maxdid'";
                $result = $pdo->query($sql);
                while ($row = $result->fetch()){
                    $lastupload = str_replace("-", "/", $row['createdat']);
                }
                echo $maxdid = max($num);
            }catch(PDOException $e){
                echo "Could not perform the operation ".$e;
            }
        ?>
        <p>
            <?php if ($totalwallpapers != '0') { ?>
                Total Wallpapers - <?php echo $totalwallpapers; ?><br />
            <?php } ?>

            <?php if ($totalcategories != '0') { ?>
                Total Categories - <?php echo $totalcategories; ?><br />
            <?php } ?>

            <?php if ($totalsubcategories != '0') { ?>
                Total Subcategories - <?php echo $totalsubcategories; ?><br />
            <?php } ?>

            <?php if ($totaldownloads != '0') { ?>
                Total Downloads - <?php echo $totaldownloads; ?><br />
            <?php } ?>

            <?php if ($lastupload != '0') { ?>
                Last Upload - <?php echo $lastupload; ?>
            <?php } ?>
        </p>
    </div><br />

    <div id = "bannerright">
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- New horiznontal -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-8918135732106370"
                data-ad-slot="4329202681"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
    </div>
</div>