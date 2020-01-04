<div class = "row">
    <?php 
        $tags = array();
        $count = '';

        try{
            $sql = "SELECT DISTINCT tagname FROM tagdetails AS t, tags AS ta WHERE t.id = ta.tag_id";
            $result = $pdo->query($sql);
            while($row = $result->fetch()){
                $tags[] = $row['tagname'];
            }
            $count = count($tags);
        }catch(PDOException $e){
            echo "An error occured" . $e;
        }
        if($tags != ''){
            echo "
            <div class = 'col-xs-12 col-md-12 col-sm-12 col-lg-12' style = 'margin-top: 1%;'>
                <h6 style = 'color: white; font-weight: bold;'>Popular Tags: </h6>
            </div>";
        }

        for($i=0; $i<$count; $i++){
            echo"
                <a href = 'searchresults.php?search=$tags[$i]' class = 'btn btn-secondary' 
                    style = 'margin-left: 1%; width: 15%; font-size: 13px; background-color: rgb(73, 133, 204); 
                    border: 1px solid rgb(73, 133, 204); float: right; margin-top: 10px;'>
                    $tags[$i]
                </a>&nbsp&nbsp&nbsp&nbsp&nbsp<br /><br />";
        }
    ?>
</div>