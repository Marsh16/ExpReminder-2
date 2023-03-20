<?php

require_once('dbConnect.php');
header('Content-Type: application/json');

$request = json_decode(file_get_contents('php://input'));

if(empty($request)){
    $response["message"] = "Request empty";
}else{
    $query = "UPDATE product SET productname = ?, category = ?, expdate = ? ,quantity = ? , productpic = ? , status = ? WHERE product_id = ?";

    $execute = $con->prepare($query);
    $execute->bind_param("ssssssi", 
                            //$request->user_id, 
                            $request->productname, 
                            $request->category, 
                            $request->expdate, 
                            $request->quantity, 
                            $request->productpic,
                            $request->status,
                            $request->product_id
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