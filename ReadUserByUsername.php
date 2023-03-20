<?php

require_once('dbConnect.php');
header('Content-Type: application/json');

$request = json_decode(file_get_contents('php://input'));
$username = $request->username;

// while ($data = mysqli_fetcassoc($execute)) {
//     array_push($response["data"], $data);
// }
 $query = "SELECT * FROM `user` WHERE username LIKE '$username'";

 $execute = $con->query($query);




while($data = mysqli_fetch_assoc($execute)){
    $response["message"] = "success";
    $response["data"] = $data;
}


$execute->close();
$con->close();

echo json_encode($response);


