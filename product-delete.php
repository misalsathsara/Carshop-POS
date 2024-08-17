<?php
include 'db.php';

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("Invalid ID.");
}

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM products WHERE id=?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $id);

if ($stmt->execute()) {
    header("Location: inventory-reports.php");
    exit;
} else {
    header("Location: 404.php") . $stmt->error;
}

$stmt->close();
$conn->close();
?>
