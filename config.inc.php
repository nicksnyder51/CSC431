<?php
# Created by Nick Snyder

    $servername = "backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com";
    $db_user = "Backend431";
    $db_password = "Backend431pass";
    $db_name = "backend431";
    $db_port = "4310";


try {
        $con = new PDO("mysql:host=$servername;port=$db_port;dbname=$db_name", $db_user, $db_password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
        die("OOPs something went wrong");
    }

?>
