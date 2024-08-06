<?php
include 'db.php';

// Retrieve form data
$id = $_POST['id'];
$name = $_POST['name'];
$cost_price = $_POST['cost_price'];
$wholesale_price = $_POST['wholesale_price'];
$price = $_POST['price'];
$selling_price = $_POST['selling_price'];
$warranty = $_POST['warranty']; // Directly use the warranty value from the form
$stock = $_POST['stock'];

// Basic validation
if (empty($id) || empty($name) || !is_numeric($cost_price) || !is_numeric($wholesale_price) || !is_numeric($price) || !is_numeric($selling_price) || empty($warranty) || !is_numeric($stock)) {
    header('Location: 404.php');
    exit;
}

// Prepare the SQL statement
$stmt = $conn->prepare("UPDATE products SET name=?, cost_price=?, wholesale_price=?, price=?, selling_price=?, warranty=?, stock=? WHERE id=?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sddddssi", $name, $cost_price, $wholesale_price, $price, $selling_price, $warranty, $stock, $id);

// Execute the statement
if ($stmt->execute()) {
    echo "Record updated successfully.";
    header("Location: inventory-reports.php");
    exit;
} else {
    header('Location: 404.php');
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>