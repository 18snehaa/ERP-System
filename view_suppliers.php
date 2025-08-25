<?php
include 'conn.php';

$sql = "SELECT * FROM suppliers ORDER BY supplier_id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Suppliers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

  <h2 class="mb-4">Suppliers List</h2>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Alt Phone</th>
        <th>PAN No</th>
        <th>Aadhar No</th>
        <th>Bank</th>
        <th>Branch</th>
        <th>GST No</th>
        <th>IFSC</th>
        <th>Address</th>
        <th>Created</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?= $row['supplier_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['alt_phone'] ?></td>
            <td><?= $row['pan_no'] ?></td>
            <td><?= $row['aadhar_no'] ?></td>
            <td><?= $row['bank_name'] ?></td>
            <td><?= $row['bank_branch'] ?></td>
            <td><?= $row['gst_no'] ?></td>
            <td><?= $row['ifsc_code'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['created_at'] ?></td>
          </tr>
      <?php } } else { ?>
          <tr><td colspan="13" class="text-center">No Suppliers Found</td></tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
