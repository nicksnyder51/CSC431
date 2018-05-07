
<?php
    $host = "backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com";
    $db_user = "Backend431";
    $db_password = "Backend431pass";
    $db_name = "backend431";
    $db_port = "4310";

$con = mysqli_connect($host,$db_user,$db_password,$db_name,$db_port);

  
    if(empty($_GET['$Cad_type']) || empty($_GET['$Cad_Coordinates']) || empty($_GET['$Cad_ID'] )
          || empty($_GET['$Neighbor_ID']) || empty($_GET['$Neighbor_SharedPoints'])    ) {
        $response["success"] = false;
    } else { 
      $Cad_type = $_GET["type"];
      $Cad_coordinates = $_GET["coordinates"];
      $Cad_ID = $_GET["cadastreID"];
      $Neighbor_ID = $_GET["neighborID"];
      $Neighbor_SharedPoints = $_GET["sharedpoints"];	
    

      $statement = mysqli_prepare($con, "INSERT INTO Cadastre(Cad_ID, Cad_Coordinates, Cad_type) VALUES (?, ?, ?)");
      mysqli_stmt_bind_param($statement, "iss", $Cad_ID,$Cad_Coordinates, $Cad_Type );
      $query = mysqli_stmt_execute($statement);
      $statement = mysqli_prepare($con, "INSERT INTO Neighbor(Cad_ID, Neighbor_ID, Neighbor_SharedPoints) VALUES (?, ?, ?)");
      mysqli_stmt_bind_param($statement, "iis", $Cad_ID,$Neighbor_ID,$Neighbor_SharedPoints );
      $query = mysqli_stmt_execute($statement);

      if ($query) {
        $response = array();
        $response["success"] = true;
      } else {
        $response["success"] = false;
      }
    echo json_encode($response);
?>

 
