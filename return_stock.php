<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "erp_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Get POST data safely
$contractor   = $_POST['contractor_name'] ?? '';
$materialCode = $_POST['material_code'] ?? '';
$materialName = $_POST['material_name'] ?? '';
$quantity     = $_POST['quantity'] ?? '';
$unit         = $_POST['unit'] ?? '';
$reason       = $_POST['reason'] ?? '';


// Simple validation
if(empty($contractor) || empty($materialCode) || empty($materialName) || empty($quantity) || empty($unit) || empty($reason)){
    echo "Please fill all fields!";
    exit;
}


// Insert into database
$sql = "INSERT INTO return_stock (contractor_name, material_code, material_name, quantity, unit, reason) 
        VALUES ('$contractor', '$materialCode', '$materialName', '$quantity', '$unit', '$reason')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
