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
        <div style = "margin-top: 0px !important; text-align:center;">
            <label style = "font-weight: bold; color: white;">Enter your email</label><br /><br />
            <input type = "email" name = "email" placeholder = "Email"><br /><br />
            <input type = "submit" name = "submit" class = "btn btn-primary" value = "Subscribe" style = "background-color: rgb(73, 133, 204); border: 1px solid rgb(73, 133, 204);"><br /><br />
        </div>
    </form>

    <div class = "webstatistics">
            <h5 id = 'populartagstext' style = "font-size: 20px !important;">Website Statistics</h5>
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
                    $maxdid = max($num);
                }catch(PDOException $e){
                    echo "Could not perform the operation ".$e;
                }
            ?>
            <p>
                <?php if ($totalwallpapers != '0') { ?>
                    Total Wallpapers - <?php 
                    if($totalwallpapers >= 1000){
                        $totalwallpapers = $downloads/1000;
                        $totalwallpapers = number_format($totalwallpapers, 1) . "k";
                    }

                    if($totalwallpapers >= 1000000){
                        $totalwallpapers = $totalwallpapers/1000000;
                        $totalwallpapers = number_format($totalwallpapers, 1) . "M";
                    }
                    echo $totalwallpapers;
                    ?><br /><br />
                <?php } ?>

                <?php if ($totalcategories != '0') { ?>
                    Total Categories - 
                    <?php
                        echo $totalcategories; 
                    ?><br /><br />
                <?php } ?>

                <?php if ($totalsubcategories != '0') { ?>
                    Total Subcategories - <?php echo $totalsubcategories; ?><br /><br />
                <?php } ?>

                <?php if ($totaldownloads != '0') { ?>
                    Total Downloads - 
                    <?php 
                        if($totaldownloads >= 1000){
                            $totaldownloads = $totaldownloads/1000;
                            $totaldownloads = number_format($totaldownloads, 1) . "k";
                        }
    
                        if($totaldownloads >= 1000000){
                            $totaldownloads = $totaldownloads/1000000;
                            $totaldownloads = number_format($totaldownloads, 1) . "M";
                        }
                        echo $totaldownloads; 
                    ?><br /><br />
                <?php } ?>

                <?php if ($lastupload != '0') { ?>
                    Last Upload -
                    <?php echo explode(" ", $lastupload)[0]; ?>
                <?php } ?>
            </p>
    </div><br />

    <div id = "bannerright">
        <p>Advertisement</p>
    </div><br />

    <div id = "bannerright">
		
    </div>
</div>