<hr />
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
                <a href = 'searchresults.php?search=$tags[$i]'  
                    style = 'margin-left: 1%; font-weight: bold;'>
                    $tags[$i]
                </a><br /><br />";
        }
    ?>
</div><hr />

<div id = "ad">
    <p>Advertisement</p>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8918135732106370",
            enable_page_level_ads: true
        });
    </script>
</div><br />