<?php

include "config.php";
$input =  file_get_contents('php://input');

$message= array();

$id = $_GET['id'];

$q = mysqli_query($con, "DELETE FROM 'seeds' WHERE 'id' = '{$id}' LIMIT 1");

$q= mysqli_query($con, "INSERT INTO 'seeds' ('type','variety','title','images','stock','specifications','price1','price5','price10','address','mobile') VALUES ('$type','$variety','$title','$images','$stock','$specifications','$price1','$price5','$price10','$address','$mobile','$id')")

if($q){
    http_response_code(201);
    $message ['status'] = "Success";
}else{
    http_response_code(422);
    $message['status'] = "Eroor"

}

echo json_encode($message);
echo mysqli_error($con);



?>
