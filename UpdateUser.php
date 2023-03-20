<?php

require_once('dbConnect.php');
header('Content-Type: application/json');

$request = json_decode(file_get_contents('php://input'));

if(empty($request)){
    $response["message"] = "Request empty";
}else{
    $query = "UPDATE user SET fullname = ?, username = ?, email = ?, phone_no = ? ,password = ? , profilepic = ? WHERE user_id = ?";

    $execute = $con->prepare($query);
    $execute->bind_param("ssssssi", 
                            $request->fullname, 
                            $request->username, 
                            $request->email, 
                            $request->phone_no, 
                            $request->password, 
                            $request->profilepic,
                            $request->user_id
                        );
    $result = $execute->execute();

    if($result){
        $response["message"] = "Success";
    }else{
        $response["message"] = "Failed";
    }
$execute->close();
}


$con->close();

echo json_encode($response);