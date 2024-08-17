<?php

include 'db.php'; // Include the database connection file

// Fetch the last sale ID
$query = "SELECT saleid, username, contact, vehicle_number, subTotal, paid_amount, balance FROM sales ORDER BY saleid DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $lastSaleId = $row['saleid'];
    $total = $row['subTotal'];
    $paid = $row['paid_amount'];
    $balance = $row['balance'];
    $vehicle_no =  $row['username'];
    $customer_name =  $row['contact'];
    $mobile =  $row['vehicle_number'];
} else {
    $lastSaleId = '----'; // Handle the case when there are no rows
}

// Fetch product details
$sql = "
SELECT c.productName, c.qty, c.item_price, c.selling_price, c.warranty
FROM cart c
JOIN products p ON c.productName = p.name
WHERE c.saleid = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare method failed
if (!$stmt) {
    die("Prepare failed: " . $conn->error . " SQL: " . $sql);
}

$stmt->bind_param('s', $lastSaleId);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an array to hold product details
$products = [];
$discount = 0;
// Fetch all rows and store them in the $products array
while ($row = $result->fetch_assoc()) {
    $discount = ($row['item_price'] - $row['selling_price']) * $row['qty'];
    $products[] = [
        'productName' => $row['productName'],
        'qty' => $row['qty'],
        'item_price' => $row['item_price'],
        'selling_price' => $row['selling_price'],
        'discount' => $discount,
        'warranty' => $row['warranty']
    ];
}

// Fetch customer details
// $sql = "SELECT vehicle_no, name, mobile FROM customers WHERE id = ?";
// $stmt = $conn->prepare($sql);

// // Check if the prepare method failed
// if (!$stmt) {
//     die("Prepare failed: " . $conn->error . " SQL: " . $sql);
// }

// $stmt->bind_param('i', $customer_id);
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows > 0) {
//     // Output customer details
//     $customer = $result->fetch_assoc();
//     $vehicle_no = $customer['vehicle_no'];
//     $customer_name = $customer['name'];
//     $mobile = $customer['mobile'];
// } else {
//     $vehicle_no = '----'; // Default values if no record found
//     $customer_name = '-----';
//     $mobile = '-----';
// }

// Fetch total discount and total
$sql = "SELECT Total_Discount, Total FROM sales WHERE saleid = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare method failed
if (!$stmt) {
    die("Prepare failed: " . $conn->error . " SQL: " . $sql);
}

$stmt->bind_param('s', $lastSaleId);
$stmt->execute();
$result = $stmt->get_result();

$discount = null; // Initialize with a default value
$total = null;

if ($row = $result->fetch_assoc()) {
    $discount = $row['Total_Discount'];
    $total = $row['Total'];
}

// Fetch the GPS details
$sql = "SELECT app_name, server, username, password, sim_no FROM gps WHERE saleid = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare method failed
if (!$stmt) {
    die("Prepare failed: " . $conn->error . " SQL: " . $sql);
}

$stmt->bind_param('s', $lastSaleId);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an array to hold GPS details
$gpsDetails = [];

// Fetch the results
while ($row = $result->fetch_assoc()) {
    $gpsDetails[] = $row;
}

// Ensure there is at least one result
if (isset($gpsDetails[0])) {
    $gps = $gpsDetails[0]; // Get the first (and presumably only) result
} else {
    $gps = ['app_name' => '', 'server' => '', 'username' => '', 'password' => '', 'sim_no' => '']; // Default values if no result
}

$stmt->close();
$conn->close(); // Close the connection

// Flush the output buffer to ensure all content is sent to the browser
ob_flush();
flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 166mm; /* Set the maximum width to fit within B5 paper with margins */
            margin: auto;
            padding: 10mm; /* Adjusted padding for better fit on B5 paper */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: white;
            display: flex;
            flex-direction: column;
            min-height: 240mm; 
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #000; /* Slightly less bold divider line after header */
            padding-bottom: 10px;
        }

        .header .logo {
            margin-right: 20px;
        }

        .header .logo img {
            max-width: 120px; /* Adjusted size for better visibility */
        }

        .header .details {
            text-align: center;
        }

        .header .details h1 {
            font-size: 20px;
            margin: 0;
        }

        .header .details p {
            margin: 5px 0;
            font-size: 12px; /* Smaller font for better fit */
        }

        .header-table {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header-table .table-left,
        .header-table .table-right {
            width: 48%;
        }

        .header-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table th,
        .header-table td {
            padding: 8px;
            font-size: 12px; /* Smaller font for better fit */
        }

        .header-table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .header-table td {
            text-align: left;
        }

        .item-details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .item-details th,
        .item-details td {
            padding: 8px;
            text-align: left;
            font-size: 12px; /* Smaller font for better fit */
        }

        .item-details th {
            background-color: #000; /* Black background for the header */
            color: #fff; /* White text for the header */
            font-weight: bold;
        }

        .payment-info {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 10px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            font-size: 12px; /* Smaller font for better fit */
        }

        .payment-info .label {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 10px; /* Smaller font size for footer text */
            padding: 10px;
            margin-top: auto; /* Push the footer to the bottom */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <div class="details">
                <h1>AUTO LANKA</h1>
                <p>Car Audio</p>
                <p>Hikkaduwa Road, Gonapinuwala.</p>
                <p>0914552161 / 0761146550</p>
            </div>
        </div>
        
        <div class="header-table">
            <div class="table-left">
                <table>
                    <tr>
                        <th>Order Date</th>
                        <td>: <?php echo date('Y-m-d'); ?></td>
                    </tr>
                    <tr>
                        <th>Order Time</th>
                        <td>: <?php echo date('H:i:s'); ?></td>
                    </tr>
                    <tr>
                        <th>Vehicle No</th>
                        <td>: <?php echo htmlspecialchars($vehicle_no); ?></td>
                    </tr>
                </table>
            </div>
            <div class="table-right">
                <table>
                    <tr>
                        <th>Customer Name</th>
                        <td>: <?php echo htmlspecialchars($customer_name); ?></td>
                    </tr>
                    <tr>
                        <th>Contact No</th>
                        <td>: <?php echo htmlspecialchars($mobile); ?></td>
                    </tr>
                    <tr>
                        <th>Order ID</th>
                        <td>: <?php echo htmlspecialchars($lastSaleId); ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="item-details">
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Item Price</th>
                        <th>Selling Price</th>
                        <th>Discount</th>
                        <th>Warranty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['productName']); ?></td>
                            <td><?php echo htmlspecialchars($product['qty']); ?></td>
                            <td><?php echo htmlspecialchars(number_format($product['item_price'], 2)); ?></td>
                            <td><?php echo htmlspecialchars(number_format($product['selling_price'], 2)); ?></td>
                            <td><?php echo htmlspecialchars(number_format($product['discount'], 2)); ?></td>
                            <td><?php echo htmlspecialchars($product['warranty']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($gps['app_name'])): ?>
        <div class="gps-info">
            <h2 style="font-size: .8rem;">GPS Details</h2>
            <table>
                <tr>
                    <td class="label">App Name - </td>
                    <td><?php echo htmlspecialchars($gps['app_name']); ?></td>
                </tr>
                <tr>
                    <td class="label">Server - </td>
                    <td><?php echo htmlspecialchars($gps['server']); ?></td>
                </tr>
                <tr>
                    <td class="label">Username - </td>
                    <td><?php echo htmlspecialchars($gps['username']); ?></td>
                </tr>
                <tr>
                    <td class="label">Password - </td>
                    <td><?php echo htmlspecialchars($gps['password']); ?></td>
                </tr>
                <tr>
                    <td class="label">SIM No - </td>
                    <td><?php echo htmlspecialchars($gps['sim_no']); ?></td>
                </tr>
            </table>
        </div>
        <?php endif; ?>

        <div class="footer">
            <div class="payment-info">
                <div style="margin-top: 25px;">Payment Information</div>
                <table>
                    <tr>
                        <td class="label">Subtotal</td>
                        <td><?php echo htmlspecialchars(number_format($total, 2)); ?></td>
                    </tr>
                    <tr>
                        <td class="label" style="border-bottom: 1px solid black;">Cash</td>
                        <td style="border-bottom: 1px solid black;"><?php echo htmlspecialchars(number_format($paid, 2)); ?></td>
                    </tr>
                    <tr>
                        <td class="label">Balance</td>
                        <td><?php echo htmlspecialchars(number_format($balance, 2)); ?></td>
                    </tr>
                </table>
            </div>
            <p>Thank you for your purchase!</p>
            <p>Terms and conditions apply.</p>
        </div>
    </div>
</body>

</html>