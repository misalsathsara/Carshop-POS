<?php
include 'db.php';

// Fetch input from the AJAX request
$product_name = $_POST['product_name'];
$quantity = intval($_POST['quantity']);


// Initialize default selling price
$sellingPrice = 00.00;

// First, get the base selling price from the products table
$sql = "SELECT selling_price FROM products WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $product_name);
$stmt->execute();
$stmt->bind_result($baseSellingPrice);

if ($stmt->fetch()) {
    $sellingPrice = $baseSellingPrice;
} 
$stmt->close();

// Then, check if there are any discounts based on the quantity in the discount table
$sql = "SELECT quantity, selling_price FROM discount WHERE product_name = ? ORDER BY quantity ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $product_name);
$stmt->execute();
$stmt->bind_result($discountQuantity, $discountSellingPrice);

while ($stmt->fetch()) {
    if ($quantity >= $discountQuantity) {
        $sellingPrice = $discountSellingPrice;
    } else {
        break; // No need to check further, as quantities are ordered ascending
    }
}
if(empty($quantity)){
    $sellingPrice = 00.00;
}
$stmt->close();
$conn->close();

// Output only the final selling price
echo number_format($sellingPrice, 2); // Ensure the output is a properly formatted number
?>
