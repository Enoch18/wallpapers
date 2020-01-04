<?php

include ('connection.php');


    try{
        $sql = "CREATE TABLE IF NOT EXISTS admin(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            firstname CHAR(50),
            lastname CHAR(50),
            email CHAR(50),
            password CHAR(50),
            passwordconfirmation CHAR(50)
        )DEFAULT CHARACTER SET utf8 ENGINE = InnoDB";
        $pdo->exec($sql);
    }catch(PDOException $e){
        echo "Could not perform the operation ".$e;
        exit();
    }

    try{
        $sql = "CREATE TABLE IF NOT EXISTS subscribers(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            email CHAR(50),
            timestamp CHAR(50)
        )DEFAULT CHARACTER SET utf8 ENGINE = InnoDB";
        $pdo->exec($sql);
    }catch(PDOException $e){
        echo "Could not perform the operation ".$e;
        exit();
    }

    try{
        $sql = "CREATE TABLE IF NOT EXISTS category(
            cat_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            cat_name CHAR(50),
            creationtime CHAR(50),
            creationdate CHAR(50)
        )DEFAULT CHARACTER SET utf8 ENGINE = InnoDB";
        $pdo->exec($sql);
    }catch(PDOException $e){
        echo "Could not perform the operation ".$e;
        exit();
    }

    try{
        $sql = "CREATE TABLE IF NOT EXISTS subcategory(
            sub_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            cat_id INT,
            sub_name CHAR(50),
            creationtime CHAR(50),
            creationdate CHAR(50)
        )DEFAULT CHARACTER SET utf8 ENGINE = InnoDB";
        $pdo->exec($sql);
    }catch(PDOException $e){
        echo "Could not perform the operation ".$e;
        exit();
    }

    try{
        $sql = "CREATE TABLE IF NOT EXISTS details(
            d_id INT PRIMARY KEY AUTO_INCREMENT,
            tag CHAR(50),
            tag2 CHAR(50) NULL,
            author CHAR(50) NULL,
            link CHAR(200) NULL,
            description TEXT,
            name CHAR(100),
            cat_id INT,
            sub_id INT,
            createdat CHAR(50),
            liveat CHAR(50)
        )DEFAULT CHARACTER SET utf8 ENGINE = InnoDB";
        $pdo->exec($sql);
    }catch(PDOException $e){
        echo "Could not perform the operation ".$e;
        exit();
    }

    try{
        $sql = "CREATE TABLE IF NOT EXISTS resolutions(
            r_id INT PRIMARY KEY AUTO_INCREMENT,
            d_id INT,
            width CHAR(100),
            height CHAR(100),
            url CHAR(200),
            createdat CHAR(50)
        )DEFAULT CHARACTER SET utf8 ENGINE = InnoDB";
        $pdo->exec($sql);
    }catch(PDOException $e){
        echo "Could not perform the operation ".$e;
        exit();
    }

    try{
        $sql = "CREATE TABLE IF NOT EXISTS visits(
            v_id INT PRIMARY KEY AUTO_INCREMENT,
            visitno INT,
            timestamp char(50)
        )DEFAULT CHARACTER SET utf8 ENGINE = InnoDB";
        $pdo->exec($sql);
    }catch(PDOException $e){
        echo "Could not perform the operation ".$e;
        exit();
    }

    try{
        $sql = "CREATE TABLE IF NOT EXISTS downloads(
            down_id INT PRIMARY KEY AUTO_INCREMENT,
            downloadno INT,
            d_id INT,
            time CHAR(100),
            date CHAR(200)
        )DEFAULT CHARACTER SET utf8 ENGINE = InnoDB";
        $pdo->exec($sql);
    }catch(PDOException $e){
        echo "Could not perform the operation ".$e;
        exit();
    }

    try{
        $sql = "CREATE TABLE IF NOT EXISTS frontpage(
            f_id INT PRIMARY KEY AUTO_INCREMENT,
            cat_id INT,
            timestamp CHAR(50)
        )DEFAULT CHARACTER SET utf8 ENGINE = InnoDB";
        $pdo->exec($sql);
    }catch(PDOException $e){
        echo "Could not perform the operation ".$e;
        exit();
    }

    try{
        $sql = "CREATE TABLE IF NOT EXISTS tags(
            t_id INT PRIMARY KEY AUTO_INCREMENT,
            d_id INT
        )DEFAULT CHARACTER SET utf8 ENGINE = InnoDB";
        $pdo->exec($sql);
    }catch(PDOException $e){
        echo "Could not perform the operation ".$e;
        exit();
    }
?>