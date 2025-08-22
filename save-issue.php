<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "store_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get header data
$store_incharge  = $_POST['store_incharge'];
$site_incharge   = $_POST['site_incharge'];
$contractor_name = $_POST['contractor_name'];
$location        = $_POST['location'];
$subdivision     = $_POST['subdivision'];
$division_circle = $_POST['division_circle'];
$issue_date      = $_POST['issue_date'];

// Insert header into issues table
$sql = "INSERT INTO issues (store_incharge, site_incharge, contractor_name, location, subdivision, division_circle, issue_date)
        VALUES ('$store_incharge', '$site_incharge', '$contractor_name', '$location', '$subdivision', '$division_circle', '$issue_date')";

if ($conn->query($sql) === TRUE) {
    $issue_id = $conn->insert_id; // get the auto id for linking items

    // Insert multiple materials
    $codes = $_POST['material_code'];
    $names = $_POST['material_name'];
    $units = $_POST['unit'];
    $quantities = $_POST['quantity'];

    for ($i = 0; $i < count($codes); $i++) {
        if (!empty($codes[$i]) && !empty($names[$i]) && !empty($units[$i]) && !empty($quantities[$i])) {
            $sql_item = "INSERT INTO issue_items (issue_id, material_code, material_name, unit, quantity)
                         VALUES ($issue_id, '{$codes[$i]}', '{$names[$i]}', '{$units[$i]}', {$quantities[$i]})";
            $conn->query($sql_item);
        }
    }

    echo "✅ Issue saved successfully!";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
