<?php
// ----------------------------
// Generate Report API
// ----------------------------

// Force JSON response & prevent PHP warnings in output
header('Content-Type: application/json');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_log.txt'); // log warnings/errors here

// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "erp_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

// Fetch POST data safely
$reportType = $_POST['reportType'] ?? '';
$startDate  = $_POST['startDate'] ?? '';
$endDate    = $_POST['endDate'] ?? '';

$response = ["status" => "error", "data" => [], "message" => ""];

// Validate input
if (empty($reportType)) {
    $response["message"] = "Report type is required";
    echo json_encode($response);
    exit;
}
if ($reportType !== "products" && (empty($startDate) || empty($endDate))) {
    $response["message"] = "Start and End dates are required";
    echo json_encode($response);
    exit;
}

// Helper function: check if table exists
function table_exists($conn, $table) {
    $stmt = $conn->prepare("SHOW TABLES LIKE ?");
    $stmt->bind_param("s", $table);
    $stmt->execute();
    $res = $stmt->get_result();
    return ($res && $res->num_rows > 0);
}

$data = [];

switch ($reportType) {
    case "issue":
        if (!table_exists($conn, "issue_stock")) {
            $response["message"] = "Table 'issue_stock' not found";
            echo json_encode($response);
            exit;
        }
        $sql = "SELECT id, CONCAT(material_name, ' (Contractor: ', contractor_name, ')') AS details,
                       DATE(issued_at) AS date, quantity AS qty
                FROM issue_stock
                WHERE DATE(issued_at) BETWEEN ? AND ?
                ORDER BY issued_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $startDate, $endDate);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        break;

    case "return":
        if (!table_exists($conn, "return_stock")) {
            $response["message"] = "Table 'return_stock' not found";
            echo json_encode($response);
            exit;
        }
        $sql = "SELECT id, CONCAT(material_name, ' (Contractor: ', contractor_name, ')') AS details,
                       DATE(returned_at) AS date, quantity AS qty
                FROM return_stock
                WHERE DATE(returned_at) BETWEEN ? AND ?
                ORDER BY returned_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $startDate, $endDate);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        break;

    case "purchase":
        if (!table_exists($conn, "purchase_stock")) {
            $response["message"] = "Table 'purchase_stock' not found";
            echo json_encode($response);
            exit;
        }
        $sql = "SELECT id, item_name AS details, date AS date,
                       CONCAT(quantity, ' @ ', amount) AS qty
                FROM purchase_stock
                WHERE date BETWEEN ? AND ?
                ORDER BY date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $startDate, $endDate);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        break;

    case "products":
        if (!table_exists($conn, "products")) {
            $response["message"] = "Table 'products' not found";
            echo json_encode($response);
            exit;
        }
        $sql = "SELECT id, name AS details, NULL AS date, stock AS qty 
                FROM products 
                ORDER BY name ASC";
        $res = $conn->query($sql);
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
        }
        break;

    default:
        $response["message"] = "Invalid report type";
        echo json_encode($response);
        exit;
}

// Success response
$response["status"] = "success";
$response["data"]   = $data;
$response["message"] = ucfirst($reportType) . " report generated successfully";

echo json_encode($response);
$conn->close();

// Note: no closing PHP tag to avoid accidental whitespace
