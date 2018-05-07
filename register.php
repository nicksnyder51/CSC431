<?php
# Created by Nick Snyder

    $host = "backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com";
    $db_user = "Backend431";
    $db_password = "Backend431pass";
    $db_name = "backend431";
    $db_port = "4310";

$con = mysqli_connect($host,$db_user,$db_password,$db_name,$db_port);

    if(empty($_GET['name']) || empty($_GET['email']) || empty($_GET['role']) || empty($_GET['registerDate']) || empty($_GET['password'])) {
      $response["success"] = false;
    } else {
      $name = $_GET["name"];
      $email = $_GET["email"];
      $role = $_GET["role"];
      $registerDate = $_GET["registerDate"];
      $password = $_GET["password"];

      $statement = mysqli_prepare($con, "INSERT IGNORE INTO userInfo (name, email, role, registerDate, password) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($statement, "sssss", $name, $email, $role, $registerDate, $password);
      $query = mysqli_stmt_execute($statement);

      if ($query) {
        $response = array();
        $response["success"] = true;
      } else {
        $response["success"] = false;
      }
    }

    echo json_encode($response);
?>
