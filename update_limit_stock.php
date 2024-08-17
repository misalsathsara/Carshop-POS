<?php
// Include database connection
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['product_id'];
    $newLimitStock = $_POST['limit_stock'];

    // Update the limit_stock in the database
    $sql = "UPDATE products SET limit_stock = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $newLimitStock, $productId);

    if ($stmt->execute()) {
        // Redirect back to the main page or display a success message
        header("Location: Product-stock.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
