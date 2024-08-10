<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection file
require 'db.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from POST request
    $numberOfItem = $_POST['numberOfItem'] ?? 0;
    $totalQty = $_POST['totalQty'] ?? 0;
    $total = $_POST['total'] ?? 0;
    $totalDiscount = $_POST['totalDiscount'] ?? 0;
    $customerProfit = $_POST['customerProfit'] ?? 0;
    $subTotal = $_POST['subTotal'] ?? 0;
    $paidAmount = $_POST['paidAmount'] ?? 0;
    $balance = $_POST['balance'] ?? 0;
    $items = $_POST['items'] ?? '[]'; 

    // Output POST data for debugging
    echo "<pre>";
    echo "POST Data:\n";
    print_r($_POST);
    echo "</pre>";

    // Generate sale ID
    $saleid = 'SALE' . time();

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Create SQL INSERT statement for sales
        $sql = "INSERT INTO sales (saleid, numberOfItem, total_Qty, Total, Total_Discount, Customer_Profit, subTotal, paid_amount, balance) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param('siiiddddd', $saleid, $numberOfItem, $totalQty, $total, $totalDiscount, $customerProfit, $subTotal, $paidAmount, $balance);

            // Execute the statement
            if (!$stmt->execute()) {
                throw new Exception('Error executing sales statement: ' . $stmt->error);
            }
            $stmt->close();
        } else {
            throw new Exception('Error preparing sales statement: ' . $conn->error);
        }

        // Decode item data
        $items = json_decode($items, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Error decoding JSON data: ' . json_last_error_msg());
        }

        // Output decoded items for debugging
        // echo "<pre>";
        // echo "Decoded Items:\n";
        // print_r($items);
        // echo "</pre>";

        foreach ($items as $item) {

            $item_price = 0;
            $total_price = 0;

            $productName = $item['productName'];
            $qty = $item['numberOfItem'];
            $selling_price = $item['sellPrice'];

            // Fetch item price from database
            $sql = "SELECT price FROM products WHERE name = ?";
            if ($stmt = $conn->prepare($sql)) {
                // Bind parameter
                $stmt->bind_param('s', $productName);

                // Execute the statement
                $stmt->execute();

                // Bind result
                $stmt->bind_result($price);
                if ($stmt->fetch()) {
                    $item_price = $price;
                } 
                $stmt->close();
            } else {
                throw new Exception('Error preparing product price statement: ' . $conn->error);
            }

            $total_price = $selling_price * $qty;

            // Output data before inserting into cart
            echo "<pre>";
            echo "Inserting into Cart:\n";
            echo "Sale ID: $saleid\n";
            echo "Product Name: $productName\n";
            echo "Quantity: $qty\n";
            echo "Item Price: $item_price\n";
            echo "Selling Price: $selling_price\n";
            echo "Total Price: $total_price\n";
            echo "</pre>";

            // Insert data into cart table
            $sql = "INSERT INTO cart (saleid, productName, qty, item_price, selling_price, total_price) 
                    VALUES (?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                // Bind parameters
                $stmt->bind_param('ssiddd', $saleid, $productName, $qty, $item_price, $selling_price, $total_price);

                // Execute the statement
                if (!$stmt->execute()) {
                    throw new Exception('Error executing cart statement: ' . $stmt->error);
                }
                $stmt->close();
            } else {
                throw new Exception('Error preparing cart statement: ' . $conn->error);
            }
        }

        // Commit transaction
        $conn->commit();
        echo 'Sale saved successfully!';
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo 'Error: ' . $e->getMessage();
    }

    // Close connection
    $conn->close();
} else {
    echo 'Invalid request method.';
}
?>