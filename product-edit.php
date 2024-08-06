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

// Discount data
$quantity1 = $_POST['quantity1'];
$price1 = $_POST['price1'];
$quantity2 = $_POST['quantity2'];
$price2 = $_POST['price2'];
$quantity3 = $_POST['quantity3'];
$price3 = $_POST['price3'];

// Basic validation
if (empty($id) || empty($name) || !is_numeric($cost_price) || !is_numeric($wholesale_price) || !is_numeric($price) || !is_numeric($selling_price) || empty($warranty) || !is_numeric($stock)) {
    header('Location: 404.php');
    exit;
}

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Prepare and execute the product update statement
    $stmt = $conn->prepare("UPDATE products SET name=?, cost_price=?, wholesale_price=?, price=?, selling_price=?, warranty=?, stock=? WHERE id=?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sddddssi", $name, $cost_price, $wholesale_price, $price, $selling_price, $warranty, $stock, $id);
    if (!$stmt->execute()) {
        throw new Exception("Error updating product: " . $stmt->error);
    }
    $stmt->close();

    // Delete previous discount records
    $delete_query = "DELETE FROM discount WHERE product_id = ?";
    $stmt = $conn->prepare($delete_query);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        throw new Exception("Error deleting previous discount records: " . $stmt->error);
    }
    $stmt->close();

    // Insert new discount records
    $insert_query = "INSERT INTO discount (product_id, product_name, quantity, selling_price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    // Bind and execute for quantity1 and price1
    if ($quantity1 && $price1) {
        $stmt->bind_param('isid', $id, $name, $quantity1, $price1);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting discount record 1: " . $stmt->error);
        }
    }

    // Bind and execute for quantity2 and price2
    if ($quantity2 && $price2) {
        $stmt->bind_param('isid', $id, $name, $quantity2, $price2);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting discount record 2: " . $stmt->error);
        }
    }

    // Bind and execute for quantity3 and price3
    if ($quantity3 && $price3) {
        $stmt->bind_param('isid', $id, $name, $quantity3, $price3);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting discount record 3: " . $stmt->error);
        }
    }

    // Commit transaction
    mysqli_commit($conn);

    echo "Record updated successfully.";
    header("Location: inventory-reports.php");
    exit;
} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($conn);
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn->close();
?>