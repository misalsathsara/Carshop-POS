<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_category = $_POST['product_category'];
    $product_warranty = $_POST['warranty'];
    $product_name = $_POST['product_name'];
    $product_cost_price = $_POST['product_cost_price'];
    $product_wholesale_price = $_POST['product_wholesale_price'];
    $product_price = $_POST['product_price'];
    $product_selling_price = $_POST['product_selling_price'];
    $product_stock = $_POST['product_stock'];

    $stmt = $conn->prepare("INSERT INTO products (category, name, cost_price, wholesale_price, price, selling_price, stock, warranty) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddddis", $product_category, $product_name, $product_cost_price, $product_wholesale_price, $product_price, $product_selling_price, $product_stock, $product_warranty);

    if ($stmt->execute()) {
        header('location:inventory-reports.php');
        exit();
    } else {
        header('location:404.php') . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>