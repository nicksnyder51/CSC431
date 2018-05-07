<?php
    require_once('config.inc.php');
    $host = "backend431.ccuuvgk8q909.us-east-2.rds.amazonaws.com";
    $db_user = "Backend431";
    $db_password = "Backend431pass";
    $db_name = "backend431";
    $db_port = "4310";

$con = mysqli_connect($host,$db_user,$db_password,$db_name,$db_port);

    //$str = file_get_contents('http://example.com/example.json/');
    //$json = json_decode($str, true); // decode the JSON into an associative array
    if(empty($_GET['Scan_Polygon']) || empty($_GET['Scan_Attributes'])) {
        $response["success"] = false;
    } else {

        $Scan_Polygon = $_GET["Scan_Polygon"];
        $Scan_Attributes = $_GET["Scan_Attributes"];
        $statement = mysqli_prepare($con, "INSERT INTO Scanned (Scan_Polygon, Scan_Attributes) VALUES (?, ?)");
        mysqli_stmt_bind_param($statement, "ss", $Scan_Polygon, $Scan_Attributes);
        $query = mysqli_stmt_execute($statement);

        if ($query) {
            $response = array();
            $response["success"] = true;
        }
        else {
            $response["success"] = false;
        }

    }


    echo json_encode($response);
?>
