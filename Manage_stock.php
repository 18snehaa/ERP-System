<?php
include 'conn.php';

// Fetch all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Stock</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

  <div class="container">
    <h2 class="mb-4">Manage Stock</h2>
       <!-- 🔍 Search Bar -->
  <div class="mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="🔍 Search...">
  </div>
    <!-- ✅ Success / Error Alerts -->
    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_GET['msg']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Sr. No</th>
          <th>Product Code</th>
          <th>Product Name</th>
          <th>Unit</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total Value</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if ($result->num_rows > 0): 
          $sr_no = 1; // start serial number
          while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $sr_no++; ?></td>
              <td><?php echo $row['product_code']; ?></td>
              <td><?php echo $row['product_name']; ?></td>
              <td><?php echo $row['unit']; ?></td>
              <td><?php echo $row['quantity']; ?></td>
              <td>₹<?php echo number_format($row['price'], 2); ?></td>
              <td>₹<?php echo number_format($row['quantity'] * $row['price'], 2); ?></td>
              <td>
                <a href="edit_product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="delete_product.php?id=<?php echo $row['product_id']; ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="8" class="text-center">No products found</td></tr>
        <?php endif; ?>
      </tbody>
    </table>

    <a href="product.html" class="btn btn-success">+ Add New Product</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
