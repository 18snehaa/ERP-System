<?php
include 'conn.php';

// ---------------- SUPPLIER SEARCH BY NAME ----------------
if (isset($_POST['ajax']) && $_POST['ajax'] == "supplier_name") {
    $query = $_POST['query'];
    $sql = "SELECT supplier_id, name AS supplier_name, gst_no, phone FROM suppliers 
            WHERE name LIKE ? LIMIT 10";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='supplier_item'
                    data-id='{$row['supplier_id']}'
                    data-name='{$row['supplier_name']}'
                    data-gst='{$row['gst_no']}'
                    data-phone='{$row['phone']}'>
                    {$row['supplier_name']}
                  </div>";
        }
    } else {
        echo "<div>No Supplier Found</div>";
    }
    $stmt->close();
    exit();
}

// ---------------- MATERIAL SEARCH BY NAME ----------------
if (isset($_POST['ajax']) && $_POST['ajax'] == "material_name") {
    $query = $_POST['query'];
    $sql = "SELECT product_id, product_name, product_code FROM products 
            WHERE product_name LIKE ? LIMIT 10";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='material_item'
                    data-id='{$row['product_id']}'
                    data-name='{$row['product_name']}'
                    data-code='{$row['product_code']}'>
                    {$row['product_name']}
                  </div>";
        }
    } else {
        echo "<div>No Material Found</div>";
    }
    $stmt->close();
    exit();
}

// ---------------- MATERIAL SEARCH BY CODE ----------------
if (isset($_POST['ajax']) && $_POST['ajax'] == "material_code") {
    $query = $_POST['query'];
    $sql = "SELECT product_id, product_name, product_code FROM products 
            WHERE product_code LIKE ? LIMIT 10";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='material_code_item'
                    data-id='{$row['product_id']}'
                    data-name='{$row['product_name']}'
                    data-code='{$row['product_code']}'>
                    {$row['product_code']}
                  </div>";
        }
    } else {
        echo "<div>No Material Code Found</div>";
    }
    $stmt->close();
    exit();
}

// ---------------- PURCHASE ORDER ----------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $supplierName = $_POST['supplierName'];
    $supplierContact = $_POST['supplierContact'];
    $supplierGst = $_POST['supplierGst'];
    $location = $_POST['location'];
    $materialName = $_POST['materialName'];
    $materialCode = $_POST['materialCode'];
    $materialQuantity = $_POST['materialQuantity'];
    $materialUnit = $_POST['materialUnit'];
    $price = $_POST['price'];
    $paymentType = $_POST['paymentType']; // Retrieve purchase type
    $purchaseDate = date('Y-m-d'); // Use the current date

    // Get supplier_id from the database
    $supplierQuery = "SELECT supplier_id FROM suppliers WHERE name = ? LIMIT 1";
    $supplierStmt = $conn->prepare($supplierQuery);
    $supplierStmt->bind_param('s', $supplierName);
    $supplierStmt->execute();
    $supplierResult = $supplierStmt->get_result();
    $supplier = $supplierResult->fetch_assoc();
    $supplier_id = $supplier['supplier_id'] ?? null;

    // Get product_id from the database
    $productQuery = "SELECT product_id FROM products WHERE product_code = ? LIMIT 1";
    $productStmt = $conn->prepare($productQuery);
    $productStmt->bind_param('s', $materialCode);
    $productStmt->execute();
    $productResult = $productStmt->get_result();
    $product = $productResult->fetch_assoc();
    $product_id = $product['product_id'] ?? null;

    // Check if supplier_id and product_id are valid
    if ($supplier_id && $product_id) {
        // Insert data into the purchase table
        $sql = "INSERT INTO purchase (supplier_id, product_id, quantity, unit_price, purchase_date, purchase_type)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iiidss', $supplier_id, $product_id, $materialQuantity, $price, $purchaseDate, $paymentType);

        if ($stmt->execute()) {
            echo "✅ Purchase Saved Successfully!";
        } else {
            echo "❌ Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "⚠ Invalid Supplier or Product.";
    }
    $supplierStmt->close();
    $productStmt->close();
    $conn->close();
}
?>