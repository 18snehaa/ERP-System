<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="3;url=index.php"> <!-- Redirect after 3 sec -->
  <title>Logout</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f9ff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .logout-box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="logout-box">
    <h2>You have been logged out</h2>
    <p>Redirecting to home page in 3 seconds...</p>
    <a href="index.php">Click here if not redirected</a>
  </div>
</body>
</html>
