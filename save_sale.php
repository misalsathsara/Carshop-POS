<?php
// Enable error reporting
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


require 'db.php'; 
session_start();

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
    // echo "<pre>";
    // echo "POST Data:\n";
    // print_r($_POST);
    // echo "Items Data:\n";
    // print_r(json_decode($items, true)); 
    // echo "</pre>";

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

        if (!empty($_SESSION['details'])) {
            // Extract details from the session array
            $details = $_SESSION['details'];
            
            // Prepare SQL statement
            $sql = "INSERT INTO gps (saleid, app_name, server, username, password, sim_no) 
                    VALUES (?, ?, ?, ?, ?, ?)";
                    
            if ($stmt = $conn->prepare($sql)) {
                // Bind parameters from session details
                $stmt->bind_param(
                    'ssssss',
                    $saleid,
                    $details['app_name'],
                    $details['server'],
                    $details['username'],
                    $details['password'],
                    $details['sim_no']
                );
        
                // Execute the statement
                if (!$stmt->execute()) {
                    throw new Exception('Error executing statement: ' . $stmt->error);
                }
                $stmt->close();
            } else {
                throw new Exception('Error preparing statement: ' . $conn->error);
            }
        
            // Clear session data
            unset($_SESSION['details']);
        }

        // Decode item data
        $items = json_decode($items, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Error decoding JSON data: ' . json_last_error_msg());
        }


        foreach ($items as $item) {
            $item_price = 0;

            $productName = $item['productName'];
            $qty = $item['qty'];
            $selling_price = $item['sellPrice'];
            $total_price = $item['totalPrice'];

            // Fetch item price from database
            $sql = "SELECT price, stock, cost_price FROM products WHERE name = ?";
            if ($stmt = $conn->prepare($sql)) {
                // Bind parameter
                $stmt->bind_param('s', $productName);

                // Execute the statement
                $stmt->execute();

                // Bind result
                $stmt->bind_result($price, $stock, $cost_price);
                if ($stmt->fetch()) {
                    $item_price = $price;
                    $item_stock = $stock;
                    $cost_price = $cost_price;
                } else {
                    throw new Exception('Product not found: ' . $productName);
                }
                $stmt->close();
            } else {
                throw new Exception('Error preparing product price statement: ' . $conn->error);
            }

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

            // Update product stock
            $new_stock = $item_stock - $qty;
            $sql = "UPDATE products SET stock = ? WHERE name = ?";
            if ($stmt = $conn->prepare($sql)) {
                // Bind parameters
                $stmt->bind_param('is', $new_stock, $productName);

                // Execute the statement
                if (!$stmt->execute()) {
                    throw new Exception('Error updating product stock: ' . $stmt->error);
                }
                $stmt->close();
            } else {
                throw new Exception('Error preparing product stock update statement: ' . $conn->error);
            }

            // Calculate profit
            $profit = (($selling_price - $cost_price) * $qty);
           
        }
                $total_profit = $profit - $totalDiscount;

            // Insert profit data into profit table
            $sql = "INSERT INTO profit (saleid, profit) VALUES (?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                // Bind parameters
                $stmt->bind_param('sd', $saleid, $total_profit);

                // Execute the statement
                if (!$stmt->execute()) {
                    throw new Exception('Error executing profit statement: ' . $stmt->error);
                }
                $stmt->close();
            } else {
                throw new Exception('Error preparing profit statement: ' . $conn->error);
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
