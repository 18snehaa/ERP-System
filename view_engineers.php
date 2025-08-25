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
  <title>View Site Engineers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <h2 class="mb-4">Site Engineers</h2>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
        <th>Alt Phone</th><th>PAN No</th><th>Aadhar No</th><th>Created</th>
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
            <td><?= $row['created_at'] ?></td>
          </tr>
      <?php } } else { ?>
          <tr><td colspan="8" class="text-center">No Engineers Found</td></tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
