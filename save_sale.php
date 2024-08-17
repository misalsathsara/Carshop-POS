<?php
// Enable error reporting
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require 'db.php'; 
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $contact2 = $_POST['contactNumber2'];
    $vehicleNumber = $_POST['vehicleNumber'];
    $numberOfItem = $_POST['numberOfItem'] ?? 0;
    $totalQty = $_POST['totalQty'] ?? 0;
    $total = $_POST['total'] ?? 0;
    $totalDiscount = $_POST['totalDiscount'] ?? 0;
    $customerProfit = $_POST['customerProfit'] ?? 0;
    $subTotal = $_POST['subTotal'] ?? 0;
    $paidAmount = $_POST['paidAmount'] ?? 0;
    $balance = $_POST['balance'] ?? 0;
    $items = $_POST['items'] ?? '[]'; 


//  echo '<pre>';
//     echo "Username: " . $username . "<br>";
//     echo "Contact Number: " . $contact2 . "<br>";
//     echo "Vehicle Number: " . $vehicleNumber . "<br>";
//     echo "Number of Items: " . $numberOfItem . "<br>";
//     echo "Total Quantity: " . $totalQty . "<br>";
//     echo "Total: " . $total . "<br>";
//     echo "Total Discount: " . $totalDiscount . "<br>";
//     echo "Customer Profit: " . $customerProfit . "<br>";
//     echo "Sub Total: " . $subTotal . "<br>";
//     echo "Paid Amount: " . $paidAmount . "<br>";
//     echo "Balance: " . $balance . "<br>";
//     echo "Items: " . htmlspecialchars($items) . "<br>";
//     echo '</pre>';


    // Generate sale ID
    // $saleid = 'SALE' . time();

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Create SQL INSERT statement for sales
        if (isset($_SESSION['pending']) && $_SESSION['pending'] == "active") {
            $insert_query = "INSERT INTO pending (username, contact, vehicle_number, numberOfItem, total_Qty, Total, Total_Discount, Customer_Profit, subTotal, paid_amount, balance) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        } else {
            $insert_query = "INSERT INTO sales (username, contact, vehicle_number, numberOfItem, total_Qty, Total, Total_Discount, Customer_Profit, subTotal, paid_amount, balance) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        }   
        // Prepare statement
        if ($stmt = $conn->prepare($insert_query)) {
            // Bind parameters
            $stmt->bind_param('sssiidddddd', $username, $contact2, $vehicleNumber, $numberOfItem, $totalQty, $total, $totalDiscount, $customerProfit, $subTotal, $paidAmount, $balance);

            if ($stmt->execute()) {
                // Get the last inserted ID
                $saleid = $conn->insert_id;
            } else {
                throw new Exception('Error executing sales statement: ' . $stmt->error);
            }
            $stmt->close();
        } else {
            throw new Exception('Error preparing sales statement: ' . $conn->error);
        }


        if (isset($_SESSION['pending']) && $_SESSION['pending'] == "active" && isset($_SESSION['customer'])) {
            $cusid = intval($_SESSION['customer']); // Sanitize customer ID
        
            $sql = "SELECT credit FROM customer WHERE id = $cusid";
            $result = mysqli_query($conn, $sql);
        
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $current_credit = $row['credit'];
        
                if (isset($paidAmount) && isset($subTotal) && $paidAmount <= $subTotal) {
                    $added = $subTotal - $paidAmount;
                    $new_credit = $current_credit + $added;
        
                    $sql = "UPDATE customer SET credit = '$new_credit' WHERE id = $cusid";
                    $result = mysqli_query($conn, $sql);
        
                    if ($result) {
                        // Update was successful
                    } else {
                        // Handle update error
                    }
                }
            } else {
                // Handle error: customer not found
            }
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
                    'isssss',
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
            $warranty = $item['warranty'];
            $qty = $item['qty'];
            $selling_price = $item['sellPrice'];
            $total_price =  $selling_price * $qty;

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
            $sql = "INSERT INTO cart (saleid, productName, warranty, qty, item_price, selling_price, total_price) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                // Bind parameters
                $stmt->bind_param('issiddd', $saleid, $productName, $warranty, $qty, $item_price, $selling_price, $total_price);

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
            $profit2 += $profit;
        }

        $total_profit = $profit2 - $totalDiscount;

        // Insert profit data into profit table
        $sql = "INSERT INTO profit (saleid, profit) VALUES (?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param('id', $saleid, $total_profit);

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
        unset($_SESSION['pending']);
        unset($_SESSION['customer']);
        // Redirect to bill.php after successfully saving the sale
        // header('Location: bill.php');
        // exit();

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