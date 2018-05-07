<?php
    $host = "backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com";
    $db_user = "Backend431";
    $db_password = "Backend431pass";
    $db_name = "backend431";
    $db_port = "4310";

$con = mysqli_connect($host,$db_user,$db_password,$db_name,$db_port);

 if(empty($_GET['polygonType']) || empty($_GET['flag']) || empty($_GET['editedBy']) || empty($_GET['approvedBy']) || empty($_GET['dateChanged'])) {
      $response["success"] = false;
    } else {
        $polygonType = $_GET["polygonType"];
        $flag = $_GET["flag"];
        $editedBy = $_GET["editedBy"];
        $approvedBy = $_GET["approvedBy"];
        $dateChanged = $_GET["dateChanged"];
        $statement = mysqli_prepare($con, "INSERT INTO changesLog (polygonType, flag, editedBy, approvedBy, dateChanged) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, "ssiis", $polygonType, $flag, $editedBy, $approvedBy, $dateChanged);
        $query = mysqli_stmt_execute($statement);

     if ($query) {
        $response = array();
        $response["success"] = true;
        $response["response"] = $query;
      } else {
        $response["success"] = false;
      }
    }

    echo json_encode($response);
?>

