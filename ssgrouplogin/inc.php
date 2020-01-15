<?php 
  include ('session.php');
  include ('../database/connection.php');
//Code for Total Visits
$visits = '';
$vnum = array();
try{
    $sql1 = "SELECT * FROM visits";
    $result = $pdo->query($sql1);
    while($row = $result->fetch()){
        $vnum[] = $row['v_id'];
    }
    $visits = count($vnum);
}catch(PDOException $e){
    echo  "Error : " . $e;
}
//End of Code for Total Visits

//Code for total downloads
$num = array();
$downloads = '';
try{
    $sql = "SELECT * FROM downloads";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $num[] = $row['d_id'];
    }
    $downloads = count($num);

} catch(PDOException $e){
    echo "Error " . $e;
}
//End of Code for total downloads

//Code for total wallpapers
$wnum = array();
$wallpapers = '';
try{
    $sql = "SELECT * FROM details";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $wnum[] = $row['d_id'];
    }
    $wallpapers = count($wnum);

} catch(PDOException $e){
    echo "Error " . $e;
}
//End Code for total wallpapers

//Code for total Subscribers
  $number = array();
  $total = '';
  try{
    $sql = "SELECT * FROM subscribers";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
      $number[] = $row['id'];
    }
    $total = count($number);
  }catch(PDOException $e){
    echo "Error : " . $e;
  }
//End of Code for total Subscribers

//Code for total Subscribers
$unumber = array();
$utotal = '';
try{
  $sql = "SELECT * FROM unsubscribers";
  $result = $pdo->query($sql);
  while ($row = $result->fetch()){
    $unumber[] = $row['id'];
  }
  $utotal = count($unumber);
}catch(PDOException $e){
  echo "Error : " . $e;
}
//End of Code for total Subscribers
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <title>SS Group Login</title>
  <link rel="shortcut icon" href = "../icons/website banner.jpg">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/stylesheet.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<script src = "../assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('#children1').hide();
  $('#children2').hide();

  $('#parent1').click(function(){
    $('#children2').hide();
    $('#children1').slideToggle();
  });

  $('#parent2').click(function(){
    $('#children1').hide();
    $('#children2').slideToggle();
  });
});
</script>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">CONTENT MENU</div><hr style = "background-color: gray;" />
      <div class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action bg-light">WELCOME <?php echo strtoupper($_SESSION['firstname']); ?></li>
        <li class="list-group-item list-group-item-action bg-light">
          <span style = "color: white;"> 
            Online
            <img src = "../icons/online.png" class = "img-responsive" style = "width: 8%; height: 8%;">
          </span><hr style = "background-color: gray; width: 130%; margin-left: -20%;" />
        </li>
        <a href="index.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-dashboard"></i> DASHBOARD </a>

        <ul class = "side">
            <li>
              <a href = "#" class="list-group-item list-group-item-action bg-light" id = "parent1"><i class="material-icons">collections</i> WALLPAPER</a>
              <ul id = "children1">
                <li><a href="viewwallpapers.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-eye"></i> View and Modify</a></li>
                <li><a href="addimage.php" class="list-group-item list-group-item-action bg-light"><i class="material-icons">add_to_photos</i> Add Wallpaper</a></li>
              </ul>
            </li>
        </ul>

        <ul class = "side">
            <li><a href = "viewcategories.php" class="list-group-item list-group-item-action bg-light" id = "parent2"><i class="fa fa-th"></i> CATEGORIES</a></li>
              <li><a href = "viewsubcategories.php" class="list-group-item list-group-item-action bg-light" id = "parent2"><i class="fa fa-th"></i> SUB-CATEGORIES </a></li>
        </ul>
        <a href="mostdownloaded.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-download"></i> TOP DOWNLOADS</a>
        <a href="frontpagecontent.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-align-justify"></i> FRONT PAGE CONTENT</a>
        <a href="activetag.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-align-justify"></i> ACTIVE TAGS</a>
        <a href="customization.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-cogs"></i> CUSOMIZATION</a>
        <a href="subscribers.php" class="list-group-item list-group-item-action bg-light"><i class="material-icons">subscriptions</i> SUBSCRIBERS (<?php echo $total ?>)</a>
        <a href="unsubscribers.php" class="list-group-item list-group-item-action bg-light"><i class="material-icons">subscriptions</i> UNSUBSCRIBERS (<?php echo $utotal ?>)</a>
        <a href="newsletters.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-newspaper-o"></i> NEWS LETTERS</a>
        <a href="logindetails.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-gear"></i> LOGIN DETAILS</a>
        <a href="logout.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-sign-out"></i> LOGOUT</a>
      </div>
    </div>
