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
                <h6 style = 'color: rgb(73, 133, 204); font-weight: bold;'>Popular Tags: </h6>
            </div>";
        }

        for($i=0; $i<$count; $i++){
            echo"
                <a href = 'searchresults.php?search=$tags[$i]'  
                    class = 'populartags'>
                    $tags[$i]
                </a><br /><br />";
        }
    ?>
</div><hr />

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