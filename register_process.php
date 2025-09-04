<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check required fields
    if (empty($_POST['email']) || empty($_POST['role']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
        echo "<script>
                alert('⚠️ Please fill all required fields.');
                window.location.href ='index.php?tab=register';
              </script>";
        exit();
    }

    $email = trim($_POST['email']);
    $role = trim($_POST['role']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>
                alert('❌ Passwords do not match!');
                window.location.href = 'index.php?tab=register';
              </script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>
                alert('⚠️ Email already registered. Please login.');
                window.location.href = 'index.php?tab=login';
              </script>";
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("sss", $email, $hashed_password, $role);

        if ($stmt_insert->execute()) {
            echo "<script>
                    alert('✅ Registration successful! Please login.');
                    window.location.href = 'index.php?tab=login';
                  </script>";
        } else {
            echo "<script>
                    alert('❌ Registration failed. Try again.');
                    window.location.href = 'index.php?tab=register';
                  </script>";
        }

        $stmt_insert->close();
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: index.php");
    exit();
}
?>
