<?php
include 'conn.php'; // your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alt_phone = $_POST['alt_phone'];
    $pan_no = $_POST['pan_no'];
    $aadhar_no = $_POST['aadhar_no'];

    $sql = "INSERT INTO site_engineers (name, email, phone, alt_phone, pan_no, aadhar_no)
            VALUES ('$name', '$email', '$phone', '$alt_phone', '$pan_no', '$aadhar_no')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Site Engineer added successfully'); window.location.href='site_engineer.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
