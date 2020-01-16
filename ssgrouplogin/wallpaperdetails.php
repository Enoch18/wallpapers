<?php 
include ('session.php');
include ('../database/connection.php');
include ('../database/createtables.php');
include ('inc.php');

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></button>
    </nav>
    <div class="container-fluid">
        <div class = "container">
            <?php
                try{
                    $original_filename = $_GET['value'];
                    $id = '';
                    $sql = "SELECT * FROM details WHERE original_filename = '$original_filename'";
                    $result = $pdo->query($sql);
                    while ($row = $result->fetch()){
                        $id = $row['d_id'];
                    }

                    $addedon = '';
                    $total = '';
                    $dtime = '';
                    $ddate = '';
                    $num = array();

                    //Code for total number of downloads on a specific wallpaper details
                    $sql1 = "SELECT * FROM downloads 
                    WHERE d_id = '$id'";
                    $result1 = $pdo->query($sql1);
                    while($row1 = $result1->fetch()){
                        $num[] = $row1['down_id'];
                        $ddate = $row1['date'];
                        $dtime = $row1['time'];
                    }
                    $total = count($num);
                    //End of Code for total number of downloads on a specific wallpaper details

                    $category = array();
                    $subcategory = array();

                    //Code for getting the category and the subcategory.
                    try{
                        $sql = "SELECT DISTINCT cat_name FROM details AS d, category AS c, catlink AS cl WHERE d.d_id = cl.d_id AND c.cat_id = cl.cat_id AND d.d_id = '$id'";
                        $result = $pdo->query($sql);
                        while ($row = $result->fetch()){
                            $category[] = $row['cat_name'];
                        }
                    }catch(PDOException $e){
                        echo "Error " . $e;
                    }
                    

                    try{
                        $sql = "SELECT DISTINCT sub_name FROM details AS d, subcategory AS s, subcatlink AS sl WHERE d.d_id = sl.d_id AND s.sub_id = sl.sub_id AND d.d_id = '$id'";
                        $result = $pdo->query($sql);
                        while ($row = $result->fetch()){
                            $subcategory[] = $row['sub_name'];
                        }
                    }catch(PDOException $e){
                        echo "Error " . $e;
                    }

                    //Code for wallpaper details
                    $sql = "SELECT * FROM details AS d, resolutions AS r
                    WHERE d.d_id = '$id' AND r.d_id = d.d_id
                    AND r.width = '1280' AND r.height = '720'";
                    $result = $pdo->query($sql);
                    while($row = $result->fetch()){
                        $sqld = "SELECT * FROM downloads WHERE d_id = '$row[d_id]'";
                        $resultd = $pdo->query($sqld);
                        $number = array();
                        while ($rowd = $resultd->fetch()){
                            $downloads = $rowd['counter'];
                        }
                        if ($downloads == 1){
                            $downloads =  $downloads. " Download";
                        }else{
                            $downloads = $downloads . " Downloads";
                        }

                        

                        echo"
                            <div class = 'col-lg-12' id = 'imagedownload'>
                                <img src = '$row[url]' class = 'img-thumbnail' style = 'width: 90%; height: 90%;' title = '$row[tag]'><br />
                                <h6 style = 'font-weight: bold'>Added on:</h6><p>$row[createdat]</p>
                                <h6 style = 'font-weight: bold'>Downloads:</h6><p>$downloads</p>
                                <h6 style = 'font-weight: bold'>Category:</h6>
                                ";
                                $cattotal = count($category);
                                $ccount = 0;
                                $inc = -1;
                                for($i=0; $i<$cattotal; $i++){
                                    $inc ++;
                                    $ccount++;
                                    echo "<p> $ccount) " . $category[$inc] ."</p>";
                                }

                                echo "<h6 style = 'font-weight: bold'>Subcategory: </h6>";
                                $subtotal = count($subcategory);
                                $ccount = 0;
                                $inc = -1;
                                for($i=0; $i<$subtotal; $i++){
                                    $inc ++;
                                    $ccount++;
                                    echo "<p> $ccount) " . $subcategory[$inc] ."</p>";
                                }
                                echo"
                                <h6 style = 'font-weight: bold'>Image title/Name:</h6> <li>$row[tag]</li>
                                <h6 style = 'font-weight: bold'>Description:</h6> <li>$row[description]</li>
                            </div>";

                        $addedon = $row['createdat'];
                        $category = $row['cat_name'];
                        //End of Code for wallpaper details
                    }
                }catch(PDOException $e){
                    echo "An error occured ". $e;
                }
            ?>
        </div>
    </div>
</div>

<script>

</script>