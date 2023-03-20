<?php

require_once('dbConnect.php');
header('Content-Type: application/json');

$request = json_decode(file_get_contents('php://input'));
$id = $request->product_id;

$query = "SELECT * FROM product WHERE product_id = ?";

$execute = $con->prepare($query);
$execute->bind_param('i', $id);
$execute->execute();

$result = $execute->get_result();
$data = $result->fetch_assoc();

if(!empty($data)){
    $response["message"] = "success";
    $response["data"] = $data;
}else{
    $response["message"] = "failed";
}

$execute->close();
$con->close();

echo json_encode($response);