<?php
include "config.php";
$input =  file_get_contents('php://input');
$data = jason_decode($input,true);
$message = array();
$type = $data['type'];
$variety = $data['variety'];
$title = $data['title'];
$images = $data['images'];
$stock = $data['stock'];
$specifications = $data['specifications'];
$price1 = $data['price1'];
$price5 = $data['price5'];
$price10 = $data['price10'];
$address = $data['address'];
$mobile= $data['mobile'];
$id = $_GET['id '];

$q = mysqli_query($con, "UPDATE 'seeds' SET ('type','variety','title','images','stock','specifications','price1','price5','price10','address','mobile')VALUES ('$type','$variety','$title','$images','$stock','$specifications','$price1','$price5','$price10','$address','$mobile') WHERE 'id'= '{$id}' LIMIT 1");

if($q){
    $message ['status'] = "Success";
}else{
    http_response_code(422);
    $message['status'] = "Eroor"

}

echo json_encode($message);
echo mysqli_error($con);

>?