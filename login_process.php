<?php
session_start();
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // ✅ Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email']   = $user['email'];
            $_SESSION['role']    = $user['role'];

            // ✅ Success popup then redirect
            echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Redirecting...</title>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
                <style>
                    .popup {
                        position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
                        background: #28a745; color: white; padding: 15px 30px;
                        border-radius: 8px; font-size: 1.1rem;
                        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
                        opacity: 1; transition: opacity 0.5s ease;
                        z-index: 1000;
                    }
                </style>
            </head>
            <body>
                <div class='popup' id='loginPopup'>✅ Successfully logged in!</div>
                <script>
                    setTimeout(() => { document.getElementById('loginPopup').style.opacity='0'; }, 1500);
                    setTimeout(() => { window.location.href='dashboard.php'; }, 2000);
                </script>
            </body>
            </html>";
            exit();
        } else {
            // ❌ Wrong password
            $_SESSION['error_msg'] = "❌ Invalid password.";
            header("Location: index.php");
            exit();
        }
    } else {
        // ❌ User not found
        $_SESSION['error_msg'] = "❌ User not found.";
        header("Location: index.php");
        exit();
    }
}
?>
