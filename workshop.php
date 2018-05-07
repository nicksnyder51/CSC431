<?php
# Created by Nick Snyder

    $host = "backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com";
    $db_user = "Backend431";
    $db_password = "Backend431pass";
    $db_name = "backend431";
    $db_port = "4310";

    $con = mysqli_connect($host,$db_user,$db_password,$db_name,$db_port);


    $string_id = $_GET["string_id"];
    $url = $_GET["url"];

    if(empty($_GET['string_id']) || empty($_GET['url'])) {
      $response["success"] = false;
    } else {
      $statement = mysqli_prepare($con, "INSERT INTO workshop (string_id, url) VALUES (?, ?)");
      mysqli_stmt_bind_param($statement, "ss", $string_id, $url);
      $result = mysqli_stmt_execute($statement);

      if($result) {
        $response = array();
        $response["success"] = true;
      } else {
        $response["success"] = false;
      }
    }

    echo json_encode($response);
?>
