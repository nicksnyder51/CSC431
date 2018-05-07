<?php

    require_once('config.inc.php');
    $host = "backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com";
    $db_user = "Backend431";
    $db_password = "Backend431pass";
    $db_name = "backend431";
    $db_port = "4310";

    $con = mysqli_connect($host,$db_user,$db_password,$db_name,$db_port);

    $Scanned_ID = $_GET["Scanned_ID"];
    $Scanned_ID = (int)$Scanned_ID;
    $statement = mysqli_prepare($con, "SELECT * FROM Scanned WHERE Scan_ID = $Scanned_ID"/* + $Scanned_ID*/);
    /*if (is_null($statement)) {
      $response["success"] = false;
    }*/
    $sql = "SELECT * FROM Scanned WHERE Scan_ID = $Scanned_ID";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["Scan_ID"]. " - Polygon Info: " . $row["Scan_Polygon"]. " - Polygon Attributes: " . $row["Scan_Attributes"]. "<br>";
    }
    } else {
      echo "0 results";
    }

    /*
    mysqli_stmt_bind_param($statement, "i", $Scanned_ID);
    $sql = mysqli_stmt_execute($statement);

    $statement = $connection->prepare($sql);
    $statement->execute();*/
    /*if($statement->rowCount())
    {
      $row_all = $statement->fetchall(PDO::FETCH_ASSOC);
      header('Content-type: application/json');
      echo json_encode($row_all);
    }
    elseif(!$statement->rowCount())
    {
      echo "no rows";
    }*/

    if ($sql) {
            $response = array();
            $response["success"] = true;
        }
        else {
            $response["success"] = false;
        }

?>

