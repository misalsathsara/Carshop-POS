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
    $items = $_POST['items'] ?? '[]'; // Assuming JSON data for items

    // Generate sale ID (for simplicity, using a timestamp here, but you can adjust it as needed)
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

        foreach ($items as $item) {
            $productName = $item['productName'];
            $qty = $item['qty'];
            $item_price = $item['item_price'];
            $selling_price = $item['selling_price'];
            $total_price = $item['total_price'];

            $sql = "INSERT INTO cart (saleid, productName, qty, item_price, selling_price, total_price) 
                    VALUES (?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                // Bind parameters
                $stmt->bind_param('ssdddd', $saleid, $productName, $qty, $item_price, $selling_price, $total_price);

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