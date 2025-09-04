<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alt_phone = $_POST['alt_phone'];
    $pan_no = $_POST['pan_no'];
    $aadhar_no = $_POST['aadhar_no'];
    $bank_name = $_POST['bank_name'];
    $bank_branch = $_POST['bank_branch'];
    $gst_no = $_POST['gst_no'];
    $ifsc_code = $_POST['ifsc_code'];
    $address = $_POST['address'];

    $sql = "INSERT INTO contractors 
        (name, email, phone, alt_phone, pan_no, aadhar_no, bank_name, bank_branch, gst_no, ifsc_code, address) 
        VALUES 
        ('$name', '$email', '$phone', '$alt_phone', '$pan_no', '$aadhar_no', '$bank_name', '$bank_branch', '$gst_no', '$ifsc_code', '$address')";

    if ($conn->query($sql) === TRUE) {
        // ✅ Redirect to view page after saving
        header("Location: view_contractors.php?msg=Contractor added successfully");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
