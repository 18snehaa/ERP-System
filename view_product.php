<?php
include 'conn.php';

// Fetch all products ordered by latest
$sql = "SELECT * FROM products ORDER BY product_id DESC";
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
    <h2 class="mb-0">Products List</h2>
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


    <!-- ✅ Success Message (if redirected with msg) -->
    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_GET['msg']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Product Code</th>
          <th>Product Name</th>
          <th>Unit</th>
          <th>Quantity</th>
          <th>Price (₹)</th>
          <th>Total Value (₹)</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['product_id'] ?></td>
              <td><?= $row['product_code'] ?></td>
              <td><?= $row['product_name'] ?></td>
              <td><?= $row['unit'] ?></td>
              <td><?= $row['quantity'] ?></td>
              <td><?= number_format($row['price'], 2) ?></td>
              <td><?= number_format($row['quantity'] * $row['price'], 2) ?></td>
              <td><?= $row['created_at'] ?? '-' ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="8" class="text-center">No Products Found</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
    <div class="col-12 text-center">
    <a href="product.html" class="btn btn-success">+ Add New Product</a>
  </div>

<!-- Bootstrap & JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
