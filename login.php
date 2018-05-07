<?php
# Created by Nick Snyder

    $host = "backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com";
    $db_user = "Backend431";
    $db_password = "Backend431pass";
    $db_name = "backend431";
    $db_port = "4310";

$con = mysqli_connect($host,$db_user,$db_password,$db_name,$db_port);

$response["success"] = false;

$email = $_GET["email"];
$password = $_GET["password"];

if(!empty($_GET['email']) || !empty($_GET['password'])) {
  $statement = mysqli_prepare($con, "select * from userInfo where email = ? and password = ?");
  mysqli_stmt_bind_param($statement, "ss", $email, $password);
  mysqli_stmt_execute($statement);

  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $id, $name, $email, $role, $registerDate, $password);


  $response = array();
  $response["success"] = false;

  while(mysqli_stmt_fetch($statement))
  {
    $response["success"] = true;
    $response["id"] = $id;
    $response["name"] = $name;
    $response["email"] = $email;
    $response["role"] = $role;
    $response["registerDate"] = $registerDate;
    $response["password"] = $password;
  }
}

echo json_encode($response);

?>
