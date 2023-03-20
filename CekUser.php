<?php

require_once('dbConnect.php');
header('Content-Type: application/json');

$request = json_decode(file_get_contents('php://input'));
$username = $request->username;
$password = $request->password;





// while ($data = mysqli_fetch_assoc($execute)) {
//     array_push($response["data"], $data);
// }



if (empty($request)) {
    $response["message"] = "Request empty";
} else {
    $query = "SELECT * FROM user WHERE username LIKE '$username' AND password LIKE '$password'";
    $execute = $con->query($query);
        
        if (mysqli_num_rows($execute) > 0) {

            $response["message"] = "1";
        } else {
            $response["message"] = "0";
        }
    
}



$con->close();

echo json_encode($response);
