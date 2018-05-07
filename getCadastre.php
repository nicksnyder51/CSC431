
<?php

    require_once('config.inc.php');
    $host = "backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com";
    $db_user = "Backend431";
    $db_password = "Backend431pass";
    $db_name = "backend431";
    $db_port = "4310";

    $con = mysqli_connect($host,$db_user,$db_password,$db_name,$db_port);

    $Cadastre_ID = $_GET["Cad_ID"];
    $Cadastre_ID = (int)$Cad_ID;

	$statement = mysqli_prepare($con, "SELECT * FROM Cadastre LEFT JOIN 	Neighbors ON Cadastre.Cad_ID = Neighbors.Cad_ID
	WHERE Cad_ID = Cadastre_ID");
  

    
    $sql = "SELECT * FROM Scanned WHERE Cad_ID = $Cadastre_ID";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["Cad_ID"]. " - Coordinates: " . $row["Cad_Coordinates"]. " - Neighbor ID: " . $row["Neighbor_ID"]. " - Shared Points" . $row["Neighbor_SharedPoints" "<br>";
    }
    } else {
      echo "0 results";
    }

   
   
    /*if($statement->rowCount())
    {
      $row_all = $statement->fetchall(PDO::FETCH_ASSOC);
      header('Content-type: application/json');
      echo json_encode($row_all);
    }

?>



