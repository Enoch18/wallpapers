<?php
    error_reporting(0);
    session_start(); 
    if (!($_SESSION['email']) || !($_SESSION['password']) || !($_SESSION['admin'])){
        $proceed = "Login to proceed";
        include('login.php');
        exit();
    }

    // include ('../database/connection.php');
    //     try{
    //         $id = array();
    //         $sql = "SELECT * FROM users";
    //         $result = $pdo->query($sql);
    //         while($row = $result->fetch()){
    //             $id[] = $row['user_id'];
    //         }
    //             echo max($id);
    //         }catch(PDOException $e){
    //             echo "Error while trying to load images. ".$e . "<br />";
    //      }

?>