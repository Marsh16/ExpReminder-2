<?php

require_once('dbConnect.php');
header('Content-Type: application/json');

$request = json_decode(file_get_contents('php://input'));

if(empty($request)){
    $response["message"] = "Request empty";
}else{
    $query = "INSERT INTO product(user_id, productname, category, expdate, quantity, productpic, status) VALUES (?,?,?,?,?,?,?)";

    $execute = $con->prepare($query);
    $execute->bind_param("sssssss", 
                            $request->user_id, 
                            $request->productname, 
                            $request->category, 
                            $request->expdate, 
                            $request->quantity, 
                            $request->productpic,
                            $request->status
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