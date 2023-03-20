<?php

require_once('dbConnect.php');
header('Content-Type: application/json');

$query = "SELECT * FROM `user` ";

$execute = $con->query($query);

$response["length"] = $execute->num_rows;
$response["data"] = array();

while($data = mysqli_fetch_assoc($execute)){
    array_push($response["data"], $data);
}


$execute->close();
$con->close();

echo json_encode($response);



