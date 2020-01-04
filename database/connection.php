<?php
    try{
        $pdo = new PDO('mysql:host=localhost; dbname=wallpapers', 'root', '123456');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');
    }catch(PDOException $e){
        echo "Could not connect to the database ".$e;
        exit();
    }
?>
