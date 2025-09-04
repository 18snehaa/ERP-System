<?php
include 'conn.php';
$sql = "SELECT * FROM site_engineers ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Contractor - Raiban Electrical Solutions</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Common Stylesheet -->
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
  <!-- Navbar -->
  <div id="header-placeholder"></div>
  
  <!-- Header Bar -->
  <div class="header-bar d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <button class="btn btn-secondary btn-sm me-3" onclick="history.back()">
        <i class="bi bi-arrow-left"></i> Back
      </button>
    </div>
    <h2 class="mb-0">Site-Engineers List</h2>
      <div>
        <button onclick="window.print()" class="btn btn-secondary">
          <i class="fas fa-print me-2"></i> Print
        </button>
      </div>
  </div>
  <div class="my-5">

  <!-- Search Bar -->
  <div class="mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="🔍 Search...">
  </div>
  <div class="table-responsive">
    <table id="dataTable" class="table table-bordered table-striped">
      <thead class="table-dark">
      <thead class="table-dark">
  <tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
    <th>Alt Phone</th><th>PAN No</th><th>Aadhar No</th>
    <th>Address</th><th>Created</th>
  </tr>
</thead>
<tbody>
  <?php if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td><?= $row['alt_phone'] ?></td>
        <td><?= $row['pan_no'] ?></td>
        <td><?= $row['aadhar_no'] ?></td>
        <td><?= $row['address'] ?></td>
        <td><?= $row['created_at'] ?></td>
      </tr>
  <?php } } else { ?>
      <tr><td colspan="9" class="text-center">No Engineers Found</td></tr>
  <?php } ?>
</tbody>
  

<!-- Bootstrap & JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>

        
  
</body>
</html>
