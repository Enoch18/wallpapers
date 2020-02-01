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
            <div class = 'row'>
                <div style = 'margin-top: 1%;'>
                    <h6 style = 'font-weight: bold; font-size: 18px !important;' id = 'populartagstext'>Popular Tags: </h6>
                </div>
            </div>";
        }

        $colors = array("#00a2ed", "#00a550", "#00ff00", "#1c39bb"," #6ca0dc", "#6f00ff", "#9c51b6", "#15f2fd", "#66c992", "#80daeb", "#c1f9a2", "#cae00d", "#cc99ff", "#e3ff00", "#f64a8a");
        
        echo "<div class = 'row'>";
            for($i=0; $i<$count; $i++){
                $color = $colors[rand(0, 14)];
                echo"
                <a href = 'searchresults.php?search=$tags[$i]' style = 'color: $color !important; margin-left: 0px !important;' class = 'populartags'>
                    $tags[$i] &nbsp;&nbsp;&nbsp;&nbsp;
                </a><br /><br />";
            }
        echo "</div>";
    ?>

<div id = "ad">
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