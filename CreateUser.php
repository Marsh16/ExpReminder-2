<?php

require_once('dbConnect.php');
header('Content-Type: application/json');

$request = json_decode(file_get_contents('php://input'));

if(empty($request)){
    $response["message"] = "Request empty";
}else{
    $query = "INSERT INTO user(fullname, username, email, phone_no, password, profilepic) VALUES (?,?,?,?,?,?)";

    $execute = $con->prepare($query);
    $execute->bind_param("ssssss", 
                            $request->fullname, 
                            $request->username, 
                            $request->email, 
                            $request->phone_no, 
                            $request->password, 
                            $request->profilepic
                        );
    $result = $execute->execute();

    if($result){
        $response["message"] = "success";
        $response["id"] = $execute->insert_id;
    }else{
        $response["message"] = "failed";
    }
    $execute->close();

}


$con->close();

echo json_encode($response);