<?php include ('../database/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Site Map</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src = "../assets/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <link href="../assets/css/global.css" rel="stylesheet">
    <link href="../assets/css/stylesheet.css" rel="stylesheet">
    <link href="../assets/css/responsiveness.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        p{
            font-size: 18px;
        }

        a{
            color: white;
            font-size: 18px;
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
    <!-- Beginning of code for the Site map content -->
    <div class = "container">
        <h3 style = "color:white; text-align: center; padding-top: 5%;">SITE MAP</h3><br /><br />
        <h4 style = "color: white;">Categories</h4>
        <div class = "row">
            <?php
                try{
                    $sql = "SELECT * FROM category ORDER BY cat_name ASC";
                    $result = $pdo->query($sql);
                    while($row = $result->fetch()){
                        echo"
                        <div class = 'col-xs-2 col-md-2 col-xs-2 col-xs-2'>
                            <a href = '../category.php?id=$row[cat_id]&catname=$row[cat_name]' style = 'font-size: 16px;'>$row[cat_name]</a><br /><br />
                        </div>";
                    }
                }catch(PDOException $e){
                    echo "Error " . $e;
                }
            ?>
        </div><br /><br />

        <h4 style = "color: white;">Subcategories</h4>
        <div class = "row">
            <?php
                try{
                    $sql = "SELECT * FROM subcategory ORDER BY sub_name ASC";
                    $result = $pdo->query($sql);
                    while($row = $result->fetch()){
                        echo"
                        <div class = 'col-xs-2 col-md-2 col-xs-2 col-xs-2'>
                            <a href = '../searchresults.php?search=$row[sub_name]' style = 'font-size: 16px;'>$row[sub_name]</a><br /><br />
                        </div>";
                    }
                }catch(PDOException $e){
                    echo "Error " . $e;
                }
            ?>
        </div><br /><br />

        <h4 style = "color: white;">Most Downloaded Images</h4>
        <div class = "row">
            <?php
                try{
                    $sql = "SELECT * FROM downloads AS da, details AS d, resolutions AS r
                    WHERE r.d_id = d.d_id AND d.d_id = da.d_id AND r.original != 'original' 
                    AND r.width = '1920' AND r.height = '1080' 
                    GROUP BY d.d_id 
                    ORDER BY da.counter DESC";
                    $result = $pdo->query($sql);
                    while ($row = $result->fetch()){
                        echo "
                        <div class = 'col-xs-2 col-md-2 col-xs-2 col-xs-2'>
                            <a href = '../searchresults.php?search=$row[tag]'>$row[tag]</a>
                        </div>";
                    }
                } catch(PDOException $e){
                    echo "Error " . $e;
                }
            ?>
        </div>
    </div><br /><br /><br /><br /><br /><br /><br />
    <!-- End of code for the Site map content -->
    <?php include ('footer.php'); ?>
</body>