<?php
include "config.php";

// Check for incoming request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON data
    $data = json_decode(file_get_contents('php://input'), true);

    // Collect form data
    $type = mysqli_real_escape_string($con, $data['type']);
    $variety = mysqli_real_escape_string($con, $data['variety']);
    $title = mysqli_real_escape_string($con, $data['title']);
    $stock = intval($data['stock']);
    $specifications = mysqli_real_escape_string($con, $data['specifications']);
    $price1kg = intval($data['price1kg']);
    $price5kg = intval($data['price5kg']);
    $price10kg = intval($data['price10kg']);
    $address = mysqli_real_escape_string($con, $data['address']);
    $mobile = mysqli_real_escape_string($con, $data['mobile']);

    // Handle images
    $images = [];
    if (!empty($_FILES['images'])) {
        $targetDir = "uploads/";
        foreach ($_FILES['images']['name'] as $key => $image) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;
            move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFilePath);
            $images[] = $fileName;
        }
    }

    // Convert images array to a comma-separated string
    $imagesList = implode(',', $images);

    // Insert data into the seeds table
    $query = "INSERT INTO seeds (type, variety, title, images, stock, specifications, price1kg, price5kg, price10kg, address, mobile)
              VALUES ('$type', '$variety', '$title', '$imagesList', $stock, '$specifications', $price1kg, $price5kg, $price10kg, '$address', '$mobile')";
    $result = mysqli_query($con, $query);

    // Check result
    if ($result) {
        http_response_code(201);
        echo json_encode(["message" => "Seed data inserted successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Failed to insert data", "error" => mysqli_error($con)]);
    }
}
?>
