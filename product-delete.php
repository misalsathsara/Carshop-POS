<?php
// Enable error reporting (for debugging purposes, remove or comment out in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

if (!isset($_POST['id']) || empty($_POST['id']) || !is_numeric($_POST['id'])) {
    die("Invalid ID.");
}

$id = $_POST['id'];

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM products WHERE id=?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $id);

// Execute the statement
if ($stmt->execute()) {
    header("Location: inventory-reports.php");
    exit;
} else {
    die("Error deleting record: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
