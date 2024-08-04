<?php
include 'db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$cost_price = $_POST['cost_price'];
$price = $_POST['price'];
$selling_price = $_POST['selling_price'];

if (empty($id) || empty($name) || !is_numeric($cost_price) || !is_numeric($price) || !is_numeric($selling_price)) {
    header('location:404.php');
    exit;
}

$stmt = $conn->prepare("UPDATE products SET name=?, cost_price=?, price=?, selling_price=? WHERE id=?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("sdddi", $name, $cost_price, $price, $selling_price, $id);

if ($stmt->execute()) {
    echo "Record updated successfully.";
    header("Location: inventory-reports.php");
    exit;
} else {
    header('location:404.php') . $stmt->error;
}

$stmt->close();
$conn->close();
?>
