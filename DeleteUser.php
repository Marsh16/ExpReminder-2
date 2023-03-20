<?php

require_once('dbConnect.php');
header('Content-Type: application/json');

$request = json_decode(file_get_contents('php://input'));
$id = $request->user_id;

if(!empty($id)){
    $query = "DELETE FROM user WHERE user_id = ?";

    $execute = $con->prepare($query);
    $execute->bind_param('i', $id);
    $result = $execute->execute();

    if($result){
        $response['message'] = "success";
    }else{
        $response['message'] = "failed";
    }

    $execute->close();
   
}else{
    $response['message'] = "Request null";
}
$con->close();   


echo json_encode($response);