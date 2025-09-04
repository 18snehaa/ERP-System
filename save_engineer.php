<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $emp_code   = $_POST['emp_code'];   // ✅ new field
    $phone      = $_POST['phone'];
    $alt_phone  = $_POST['alt_phone'];
    $pan_no     = $_POST['pan_no'];
    $aadhar_no  = $_POST['aadhar_no'];
    $address    = $_POST['address'];

    // ✅ Added emp_code column in insert
    $sql = "INSERT INTO site_engineers 
            (name, email, emp_code, phone, alt_phone, pan_no, aadhar_no, address)
            VALUES 
            ('$name', '$email', '$emp_code', '$phone', '$alt_phone', '$pan_no', '$aadhar_no', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Site Engineer added successfully'); window.location.href='view_engineers.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
