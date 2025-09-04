<?php
// filepath: c:\xampp\htdocs\Raiban-Web\index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Raiban Electrical Solutions</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="login-page d-flex align-items-center justify-content-center vh-100 bg-light">

  <div class="card shadow-lg rounded-4 overflow-hidden" style="max-width: 900px; width: 100%;">
    <div class="row g-0">

      <!-- Left Column (Welcome) -->
      <div class="col-md-6 bg-primary text-white d-flex flex-column justify-content-center p-4">
       
      <h2 class="fw-bold mb-3">
  Welcome to <b>Raiban Electrical Solution Store ERP System</b>⚡
</h2>

        <p class="mb-0">
          Manage your <strong> Material stocks</strong>, and <strong> Generate reports</strong> 
          in real time with ERP system.  
          <br><br>
          Please <b>login</b> to continue, or <b>register</b> if you are new.
        </p>
      </div>

      <!-- Right Column (Login/Register Tabs) -->
      <div class="col-md-6 p-4">
        
        <!-- Tabs -->
        <ul class="nav nav-pills nav-justified mb-4" id="authTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" 
              data-bs-target="#login" type="button" role="tab">🔑 Login</button>
          </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="authTabsContent">

          <!-- Login Form -->
          <div class="tab-pane fade show active" id="login" role="tabpanel">
            <form id="loginForm" action="login_process.php" method="POST" novalidate>
              <div class="mb-3">
                <input type="email" name="email" class="form-control" required placeholder="Email">
              </div>
              <div class="mb-3 position-relative">
                <input type="password" id="password" name="password" 
                  class="form-control pe-5" required placeholder="Password">
                <button type="button" id="togglePassword" 
                  class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2">
                  <i class="fa-solid fa-eye"></i>
                </button>
              </div>
              <div class="d-flex justify-content-between mb-3">
                <div>
                  <input type="checkbox" id="remember"> <label for="remember">Remember me</label>
                </div>
                <a href="#">Forgot Password?</a>
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
          </div>

         

  <!-- Bootstrap + Custom JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
