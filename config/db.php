<?php
    $servername = "files.000webhost.com ";
    $username = "usertestdb";
    $password = ")GUs@D1XwT)*hC%YQfEx";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=dvcss", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>