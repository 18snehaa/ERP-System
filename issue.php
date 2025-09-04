<?php
$servername = "localhost";
$username   = "root";       
$password   = "";           
$dbname     = "erp_system"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Only proceed if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Safely get POST data using null coalescing operator
    $storeIncharge   = $_POST['storeIncharge'] ?? '';
    $siteIncharge    = $_POST['siteIncharge'] ?? '';
    $siteSupervisor  = $_POST['siteSupervisor'] ?? '';
    $contractor      = $_POST['contractor'] ?? '';
    $circle          = $_POST['circle'] ?? '';
    $division        = $_POST['division'] ?? '';
    $subDivision     = $_POST['subDivision'] ?? '';
    $sectionName     = $_POST['sectionName'] ?? '';
    $materialCode    = $_POST['materialCode'] ?? '';
    $productId       = $_POST['productId'] ?? null; // hidden field
    $materialName    = $_POST['materialName'] ?? '';
    $materialUnit    = $_POST['materialUnit'] ?? '';
    $materialQuantity= $_POST['materialQuantity'] ?? '';

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO issue 
        (store_incharge, site_incharge, site_supervisor, contractor, circle, division, sub_division, section_name, material_code, product_id, material_name, material_unit, material_quantity) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssssssssisssi", 
        $storeIncharge, 
        $siteIncharge, 
        $siteSupervisor, 
        $contractor, 
        $circle, 
        $division, 
        $subDivision, 
        $sectionName, 
        $materialCode, 
        $productId, 
        $materialName, 
        $materialUnit, 
        $materialQuantity
    );

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
