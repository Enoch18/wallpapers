<script src = "assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var total = window.matchMedia("(max-width:800px)");
        if ($(window).width() < 974){
            $('#col1').hide();
            $('#catbtn').show();
            $('#catbtn').click(function(){
                $('#col1').slideToggle();
            });
        }
    });
</script>

<button id = "catbtn" class = "btn btn-primary">View Categories</button>
<div class = "col-lg-2" id = "col1">
    <ul class = "list-group">
        <?php 
            $total1 = $pdo->query("SELECT COUNT(*) FROM details")->fetchColumn();
            echo "<li class = 'list-group-item'><a href = 'allcategories.php'>All Categories ($total1)</a></li>";
            try{
                $sql = "SELECT * FROM category ORDER BY cat_name ASC";
                $result = $pdo->query($sql);
                while($row = $result->fetch()){
                    $total = $pdo->query("SELECT COUNT(*) FROM details AS d, catlink as c WHERE d.d_id = c.d_id AND c.cat_id = '$row[cat_id]'")->fetchColumn();
                    echo "<li class = 'list-group-item'><a href = 'category.php?id=$row[cat_id]&catname=$row[cat_name]'>$row[cat_name] ($total)</a></li>";
                }
            }catch(PDOException $e){
                    echo "An error occured ". $e;
            }
        ?>
    </ul>
</div>