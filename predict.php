<?php
    include ('database/connection.php');
    $search = $_GET['value'];
    echo "<ul class = 'list-group'>";
    $sql = "SELECT * FROM details WHERE tag LIKE '%$search%'";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()){
       echo "<li class = 'list-group-item select' style = 'background-color:gray; cursor: pointer;'>" . $row['tag'] . "</li>";
    }
    echo "</ul>"
?>