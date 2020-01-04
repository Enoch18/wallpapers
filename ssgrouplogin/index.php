<?php 
  include ('session.php');
  include ('../database/connection.php');
  include ('inc.php'); 


$visits = '';
$vnum = array();
$ago = $_GET['time'];
$time = '';
$week = '';
$period = '';
$wnum = array();
$wallpapers = '';
$number = array();
$total = '';

$period = "All Times";

//Code for Total Visits
if($ago == 'oneweek'){
    $time = date("Y-m-d H:i:s");
    $week = date('Y-m-d H:i:s', strtotime($time. ' - 1 week'));
    $period = "Past One Week";
}

if($ago == 'onemonth'){
    $time = date("Y-m-d H:i:s");
    $week = date('Y-m-d H:i:s', strtotime($time. ' - 1 month'));
    $period = "Past One Month";
}

if($ago == 'oneday'){
    $time = date("Y-m-d H:i:s");
    $week = date('Y-m-d H:i:s', strtotime($time. ' - 1 day'));
    $period = "Past One Day";
}

if($ago != ''){
    $visits = '';
    $vnum = array();
    try{
        $sql1 = "SELECT * FROM visits
        WHERE timestamp BETWEEN '$week' AND '$time'";
        $result = $pdo->query($sql1);
        while($row = $result->fetch()){
          $visits = $row['visitno'];
        }
    }catch(PDOException $e){
        echo  "Error : " . $e;
    }
    //End of Code for Total Visits

    //Code for total wallpapers
    $wnum = array();
    $wallpapers = '';
    try{
        $sql = "SELECT * FROM details
        WHERE createdat BETWEEN '$week' AND '$time'";
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
        $sql = "SELECT * FROM subscribers
        WHERE timestamp BETWEEN '$week' AND '$time'";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()){
        $number[] = $row['id'];
        }
        $total = count($number);
    }catch(PDOException $e){
        echo "Error : " . $e;
    }
    //End of Code for total Subscribers

    //Code for total downloads
    if($ago == 'oneday'){
        $num = array();
        $downloads = '';
        try{
          $date = date('Y-m-d');
            $week = explode(" ", $week);
            $time = explode(" ", $time);
            $sql = "SELECT * FROM downloads
            WHERE time BETWEEN '00:00:01' AND '$time[1]'";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()){
                $num[] = $row['counter'];
            }
            $downloads = array_sum($num);

        } catch(PDOException $e){
            echo "Error " . $e;
        }
    }

    if($ago != 'oneday'){
        $num = array();
        $downloads = '';
        try{
            $week = explode(" ", $week);
            $time = explode(" ", $time);
            $sql = "SELECT * FROM downloads
            WHERE date BETWEEN '$week[0]' AND '$time[0]'";
            $result = $pdo->query($sql);
            while ($row = $result->fetch()){
                $num[] = $row['counter'];
            }
            $downloads = array_sum($num);

        } catch(PDOException $e){
            echo "Error " . $e;
        }
    }
}

if($ago == ''){
    $visits = '';
    $vnum = array();
    try{
        $sql1 = "SELECT * FROM visits";
        $result = $pdo->query($sql1);
        while($row = $result->fetch()){
            $visits = $row['visitno'];
        }
    }catch(PDOException $e){
        echo  "Error : " . $e;
    }
    //End of Code for Total Visits

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

    //Code for total downloads
    $num = array();
    $downloads = '';
    try{
        $week = explode(" ", $week);
        $time = explode(" ", $time);
        $sql = "SELECT * FROM downloads";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()){
            $num[] = $row['counter'];
        }
        $downloads = array_sum($num);

    } catch(PDOException $e){
        echo "Error " . $e;
    }
}
//End of Code for total downloads
  ?>

    <style>
        #piechart{
            width: 100%; 
            height: 500px;
        }

        @media (max-width: 1500px){
            #piechart{
                width: 100%; 
                height: 500px;
            }
        }

        @media (max-width: 1000px){
            #piechart{
                width: 100%; 
                height: 500px;
            }
        }

        @media (max-width: 800px){
            #piechart{
                width: 100%; 
                height: 500px;
            }
        }

        @media (max-width: 600px){
            #piechart{
                width: 100%; 
                height: 500px;
            }
        }
    </style>
    <!-- Beginning of code for the Pie chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Activity', 'Hours per Day'],
          ['Visits',     <?php echo $visits; ?>],
          ['Wallpapers',      <?php echo $wallpapers; ?>],
          ['Downloads',  <?php echo $downloads; ?>],
          ['Subscribers', <?php echo $total; ?>],
        ]);

        var options = {
          title: 'Website Activities for the <?php echo strtolower($period); ?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
      </nav>

      <div class="container-fluid">
        <?php
          echo"
          <h4 style = 'margin-top: 3%; margin-left: 1%;'>DASHBOARD</h4>
          <div class = 'row'>
            <div class = 'col-lg-1'>
                <h6>View for </h6><br />
            </div>

            <div class = 'col-lg-1'>
                <a href = 'index.php' class = 'btn btn-primary' style = 'width: 100%'>All Times</a><br /><br />
            </div>

            <div class = 'col-lg-1'>
                <a href = '?time=oneday' class = 'btn btn-primary' style = 'width: 100%'>One Day</a><br /><br />
            </div>

            <div class = 'col-lg-1'>
                <a href = '?time=oneweek' class = 'btn btn-primary' style = 'width: 100%'>One Week</a><br /><br />
            </div>

            <div class = 'col-lg-1'>
                <a href = '?time=onemonth' class = 'btn btn-primary' style = 'width: 100%'>One Month</a><br /><br />
            </div>

          </div>
          <h5 style = 'margin-top: 0px; margin-left: 1%;'>$period</h5>
          <div class = 'col-lg-12'>
            <div class = 'row'>
              <div class = 'col-xs-12 col-sm-6 col-md-4 col-lg-3'>
                <div class = 'content' style = 'background-color: blue !important;'>
                  <h5 style = 'color: white; margin-left: 5%; padding-top: 5%;'>VISITS</h5>
                  <h3 style = 'color: white; margin-left: 5%;'>$visits Visits</h3>
                  <div style = 'background-color: black; margin-top: 15%;'>
                  </div>
                </div>             
              </div>

              <div class = 'col-xs-12 col-sm-6 col-md-4 col-lg-3'>
                <div class = 'content' style = 'background-color: green !important;'>
                  <h5 style = 'color: white; margin-left: 5%; padding-top: 5%;'>NUMBER OF SUBSCRIBERS</h5>
                  <h3 style = 'color: white; margin-left: 5%;'>$total Subscribers</h3>
                  <div style = 'background-color: black; margin-top: 15%;'>
                  </div>
                </div>             
              </div>

              <div class = 'col-xs-12 col-sm-6 col-md-4 col-lg-3'>
                <div class = 'content' style = 'background-color: rgba(250, 134, 9, 1) !important;'>
                  <h5 style = 'color: white; margin-left: 5%; padding-top: 5%;'>NUMBER OF DOWNLOADS</h5>
                  <h3 style = 'color: white; margin-left: 5%;'>$downloads Downloads</h3>
                  <div style = 'background-color: black; margin-top: 15%;'>
                  </div>
                </div>             
              </div>

              <div class = 'col-xs-12 col-sm-6 col-md-4 col-lg-3'>
                <div class = 'content' style = 'background-color: rgba(245, 10, 10, 0.8) !important; opacity: 1;'>
                  <h5 style = 'color: white; margin-left: 5%; padding-top: 5%;'>TOTAL WALLPAPERS</h5>
                  <h3 style = 'color: white; margin-left: 5%;'>$wallpapers Wallpapers</h3>
                  <div style = 'background-color: gray; margin-top: 15%; opacity 1;'>
                  </div>
                </div>             
              </div>
            </div>
          </div>

          <div class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12' style = 'margin-top: 100px; border: 1px solid black;'>
            <div id='piechart'></div>
          </div>";
        ?>

      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
