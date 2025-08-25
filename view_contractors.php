<?php
include 'conn.php';
$sql = "SELECT * FROM contractors ORDER BY contractor_id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Contractors</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <h2 class="mb-4">Contractors List</h2>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
        <th>Alt Phone</th><th>PAN</th><th>Aadhar</th>
        <th>Bank</th><th>Branch</th><th>GST</th><th>IFSC</th><th>Address</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?= $row['contractor_id'] ?></td>
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
          </tr>
      <?php } } else { ?>
          <tr><td colspan="12" class="text-center">No Contractors Found</td></tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
