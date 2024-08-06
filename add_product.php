<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Product Details
    $product_category = $_POST['product_category'];
    $product_warranty = $_POST['warranty'];
    $product_name = $_POST['product_name'];
    $product_cost_price = $_POST['product_cost_price'];
    $product_wholesale_price = $_POST['product_wholesale_price'];
    $product_price = $_POST['product_price'];
    $product_selling_price = $_POST['product_selling_price'];
    $product_stock = $_POST['product_stock'];

    // Discount Details
    $quantities = [
        $_POST['quantity1'],
        $_POST['quantity2'],
        $_POST['quantity3']
    ];
    $prices = [
        $_POST['price1'],
        $_POST['price2'],
        $_POST['price3']
    ];

    // Insert Product Details
    $stmt = $conn->prepare("INSERT INTO products (category, name, cost_price, wholesale_price, price, selling_price, stock, warranty) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddddis", $product_category, $product_name, $product_cost_price, $product_wholesale_price, $product_price, $product_selling_price, $product_stock, $product_warranty);

    if ($stmt->execute()) {
        // Get the last inserted product ID
        $product_id = $stmt->insert_id;
        $stmt->close();

        // Insert Discount Details
        $discount_query = "INSERT INTO discount (product_id, product_name, quantity, selling_price) VALUES (?, ?, ?, ?)";
        $discount_stmt = $conn->prepare($discount_query);

        for ($i = 0; $i < 3; $i++) {
            if (!empty($quantities[$i]) && !empty($prices[$i])) {
                $discount_stmt->bind_param("isid", $product_id, $product_name, $quantities[$i], $prices[$i]);
                $discount_stmt->execute();
            }
        }

        $discount_stmt->close();
        $conn->close();

        // Redirect to a confirmation page
        header('Location: inventory-reports.php');
        exit();
    } else {
        // Redirect to an error page with error message
        header('Location: 404.php');
        exit();
    }
}
?>