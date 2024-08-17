<?php
include 'db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate the custom ID
    $prefix = 'AL';
    $query = "SELECT id FROM products ORDER BY id DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastId = $row['id'];
        $numericPart = (int)substr($lastId, 2); // Remove the 'AL' prefix and convert to integer
        $newId = $prefix . str_pad($numericPart + 1, 3, '0', STR_PAD_LEFT); // Increment and pad with leading zeros
    } else {
        // If no records exist, start with AL001
        $newId = $prefix . '001';
    }

    // Product Details
    $product_category = $_POST['product_category'];
    $product_warranty = $_POST['warranty'];
    $product_name = $_POST['product_name'];
    $product_cost_price = $_POST['product_cost_price'];
    $product_price = $_POST['product_price'];
    $product_selling_price = $_POST['product_selling_price'];
    $product_stock = $_POST['product_stock'];

    if (empty($product_category) || empty($product_warranty) || empty($product_name) || empty($product_cost_price) || empty($product_price) || empty($product_selling_price) || empty($product_stock)) {
        echo '<script>alert("Please fill in all required fields."); window.history.back();</script>';
        exit;
    }
    
    // Insert Product Details with custom ID
    $stmt = $conn->prepare("INSERT INTO products (id, category, name, cost_price, price, selling_price, stock, warranty) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdddis", $newId, $product_category, $product_name, $product_cost_price, $product_price, $product_selling_price, $product_stock, $product_warranty);

    if ($stmt->execute()) {
        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to a confirmation page
        header('Location: inventory-reports.php');
        exit();
    } else {
        // Redirect to an error page with error message
        //header('Location: 404.php');
        exit();
    }
}
?>
