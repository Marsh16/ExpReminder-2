
<?php

require_once('dbConnect.php');
header('Content-Type: application/json');

$request = json_decode(file_get_contents('php://input'));
$user_id = $request->user_id;

// while ($data = mysqli_fetcassoc($execute)) {
//     array_push($response["data"], $data);
// }
 $query = "SELECT * FROM `product` WHERE user_id LIKE '$user_id'";

 $execute = $con->query($query);

 $response["length"] = $execute->num_rows;
 $response["data"] = array();


while($data = mysqli_fetch_assoc($execute)){
    $response["message"] = "success"; 
    array_push($response["data"], $data);

}


$execute->close();
$con->close();

echo json_encode($response);

