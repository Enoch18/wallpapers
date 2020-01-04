<div class = "container" id = "pages">
    <?php if ($pages == 1 && !($pages > 1)){ ?>
    <br />
    <!-- <ul class = "pagination">           
        <li><a href = "#_" class = "btn btn-primary">First</a></li>
        <li><a href = "?pageno=<?php //echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php //echo $pageno ?></a></li>
        <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p></li>
        <li><a href = "?pageno=<?php //echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php //echo $pages ?></a></li>
        <?php
            // if ($pages == 1 && !($pages > 1)){
            //     echo "<li><a href = '#_' class = 'btn btn-primary' style = 'margin-left: 20px; color:white;'>Last</a></li>";
            // }
        ?>
    </ul> -->
    <?php } ?>

    <?php if ($pages > 1 && $pageno < $pages){ ?>
        <br />
        <ul class = "pagination"> 
        <?php if ($pageno == 1){ ?>          
            <li><a href = "#_" class = "btn btn-primary" style = "color: white;">First</a>
        <?php } ?>

        <?php if ($pageno > 1){ ?>          
            <li><a href = "?pageno=<?php echo $pageno - 1; ?>" class = "btn btn-primary"><<< </a>
        <?php } ?>
        <li><a href = "?pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno ?></a></li>
        <li><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p></li>
        <li><a href = "?pageno=<?php echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages ?></a></li>
        <li><a href = "?pageno=<?php echo $pageno + 1; ?>" class = 'btn btn-primary' style = 'margin-left: 20px;'>>>> </a></li>
        </ul>
    <?php } ?>

    <?php if ($pageno == $pages && $pages != 1){ ?>
        <br />
        <ul class = "pagination">           
            <li><a href = "?pageno=<?php echo $pageno - 1; ?>" class = "btn btn-primary"> <<< </a>
            <li><a href = "?pageno=<?php echo $pageno; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pageno ?></a></li>
            <li style = "color: black !important;"><p class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'>of</p></li>
            <li><a href = "?pageno=<?php echo $pages; ?>" class = 'btn btn-primary' style = 'margin-left: 20px; background-color: white; color:black;'><?php echo $pages ?></a></li>
            <li><a href = "#_" class = 'btn btn-primary' style = 'margin-left: 20px;'>Last</a></li>
        </ul>
    <?php } ?>

    <?php if ($pages == 0 || $pages < 0){ ?>
        <br />
        <h4 style = "color: white;">No Wallpapers yet</h4>
        <?php } ?>
    </div>