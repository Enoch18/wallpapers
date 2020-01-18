<?php include ('database/connection.php'); ?>
<?php
    $sql = "SELECT * FROM customizations WHERE name = 'website'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
?>

<style>
body{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
    color: <?php echo $row['textcolor']; ?> !important;
    font-size: <?php echo $row['fontsize']; ?> !important;
}

p, a, #footer li, .mainalttags{
    color: <?php echo $row['textcolor']; ?> !important;
    font-size: <?php echo $row['fontsize']; ?> !important;
}

h1, h2, h3, h4, h5, h6, b, a{
    color: <?php echo $row['textcolor']; ?> !important;
}

.footercontent a{
    color: blue !important;
}

.navbar{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}

#footer{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}

#navbar{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}

.searchbar{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}

#row{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}

#inner{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}

#ads{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}

#bannerright{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}

#ad{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}

.tags{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}
</style>

<?php } ?>

<!-- Buttons Code -->
<?php
    $sql = "SELECT * FROM customizations WHERE name = 'buttons'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
?>

<style>
.btn-info, .btn{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
    color: <?php echo $row['textcolor']; ?> !important;
    border: 1px solid <?php echo $row['bordercolor']; ?> !important;
}

#resolutions a, #relatedtext, #populartagstext{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
    color: <?php echo $row['textcolor']; ?> !important;
}

.btn-info:hover{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
    border: 1px solid <?php echo $row['bordercolor']; ?> !important;
    opacity: 0.7;
}

.nav-item > a{
    color: <?php echo $row['textcolor']; ?> !important;
}

.list-group-item{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
}

.list-group-item a{
    color: <?php echo $row['textcolor']; ?> !important;
}
</style>

<?php } ?>

<!-- Headings Code -->

<?php
    $sql = "SELECT * FROM customizations WHERE name = 'headings'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
?>

<style>
#heading, #addedonheader{
    background-color: <?php echo $row['backgroundcolor']; ?> !important;
    color: <?php echo $row['textcolor']; ?> !important;
}
</style>

<?php } ?>



<!-- Left Sidebar -->

<?php
    $sql = "SELECT * FROM customizations WHERE name = 'buttons'";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
?>

<style>

</style>

<?php } ?>