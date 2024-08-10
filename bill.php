<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php'; // Include the database connection file

// Fetch the last sale ID
$query = "SELECT saleid,subTotal,paid_amount,balance FROM sales ORDER BY saleid DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $lastSaleId = $row['saleid'];
    $total = $row['subTotal'];
    $paid = $row['paid_amount'];
    $balance = $row['balance'];
} else {
    $lastSaleId = '----'; // Handle the case when there are no rows
}

// Fetch product details
$sql = "
SELECT c.productName, c.qty, c.selling_price, p.warranty
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

// Fetch all rows and store them in the $products array
while ($row = $result->fetch_assoc()) {
    $products[] = [
        'productName' => $row['productName'],
        'qty' => $row['qty'],
        'selling_price' => $row['selling_price'],
        'warranty' => $row['warranty']
    ];
}


$sql = "SELECT vehicle_no, name, mobile FROM customers WHERE id = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare method failed
if (!$stmt) {
    die("Prepare failed: " . $conn->error . " SQL: " . $sql);
}

$stmt->bind_param('i', $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output customer details
    $customer = $result->fetch_assoc();
    $vehicle_no = $customer['vehicle_no'];
    $customer_name = $customer['name'];
    $mobile = $customer['mobile'];
} else {
    $vehicle_no = '----'; // Default values if no record found
    $customer_name = '-----';
    $mobile = '-----';
}

// Fetch total discount and total
$sql = "SELECT Total_Discount, Total FROM sales WHERE saleid = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare method failed
if (!$stmt) {
    die("Prepare failed: " . $conn->error . " SQL: " . $sql);
}

$stmt->bind_param('s', $lastSaleId); // 'i' for integer if it's numeric
$stmt->execute();
$result = $stmt->get_result();

// Fetch the Total_Discount from the result
$discount = null; // Initialize with a default value
$total = null;

if ($row = $result->fetch_assoc()) {
    $discount = $row['Total_Discount'];
    $total = $row['Total'];
}

// Fetch the GPS details
$sql = "SELECT 	app_name, server, username, password, sim_no FROM gps WHERE saleid = ?";
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
?>



</html>
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
        padding: 20px;
        background-color: #f9f9f9;
        color: #333;
    }

    .container {
        width: 100%;
        max-width: 850px;
        margin: auto;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header,
    .footer {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        font-size: 24px;
        margin: 0;
    }

    .header p {
        margin: 5px 0;
        font-size: 14px;
    }

    .details,
    .item-details,
    .payment-info {
        margin-bottom: 20px;
    }

    .details table,
    .item-details table,
    .payment-info table {
        width: 100%;
        border-collapse: collapse;
    }

    .details table td,
    .item-details table td,
    .payment-info table td {
        padding: 8px;
        border: 1px solid #ddd;
        font-size: 14px;
    }

    .details table td.label,
    .item-details table td.label,
    .payment-info table td.label {
        font-weight: bold;
        background-color: #f2f2f2;
        width: 30%;
    }

    .footer p {
        font-size: 12px;
        margin: 0;
    }
    </style>
</head>

<body>
</body>
<div class="container">
    <div class="header">
        <h1>AUTO LANKA</h1>
        <p>Car Audio</p>
        <p>Hikkaduwa Road, Gonapinuwala.</p>
        <p>0914552161 / 0761146550</p>
    </div>
    <div class="details">
        <table>
            <tr>
                <td class="label">Order Date</td>
                <td id="orderDate">: </td>
                <td class="label">Order Time</td>
                <td id="orderTime">: </td>
            </tr>

            <script>
            function updateDateTime() {
                const now = new Date();

                // Format date as YYYY-MM-DD
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-based
                const day = String(now.getDate()).padStart(2, '0');
                const date = `${year}-${month}-${day}`;

                // Format time as HH:MM:SS
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const time = `${hours}:${minutes}:${seconds}`;

                document.getElementById('orderDate').textContent = ': ' + date;
                document.getElementById('orderTime').textContent = ': ' + time;
            }

            // Update the date and time when the page loads
            updateDateTime();
            </script>


            <tr>
                <td class="label">Vehicle No</td>
                <td>: <?php echo htmlspecialchars($vehicle_no); ?></td>
                <td class="label">Order ID</td>
                <td>: <?php echo htmlspecialchars($lastSaleId); ?></td>
            </tr>
            <tr>
                <td class="label">INVOICE TO</td>
                <td>: <?php echo htmlspecialchars($customer_name); ?></td>
                <td class="label">Contact No</td>
                <td>: <?php echo htmlspecialchars($mobile); ?></td>
            </tr>
        </table>
    </div>
    <div class="item-details">
        <h2>Item Details</h2>
        <table>
            <?php foreach ($products as $product): ?>
            <tr>
                <td class="label">ITEM NAME</td>
                <td><?php echo htmlspecialchars($product['productName']); ?></td>
            </tr>
            <tr>
                <td class="label">WARRANTY</td>
                <td><?php echo htmlspecialchars($product['warranty']); ?></td>
            </tr>
            <tr>
                <td class="label">QTY</td>
                <td><?php echo htmlspecialchars($product['qty']); ?></td>
            </tr>
            <tr>
                <td class="label">PRICE</td>
                <td><?php echo htmlspecialchars($product['selling_price']); ?></td>
            </tr>
            <tr>
                <td>

                </td>
            </tr>
            <?php endforeach; ?>


            <tr>
                <td class="label">DISCOUNT</td>
                <td><?php echo htmlspecialchars($discount); ?></td>
            </tr>

            <tr>
                <td class="label">TOTAL PRICE</td>
                <td><?php echo htmlspecialchars($total); ?></td>
            </tr>
            <tr>
                <td>

                </td>
            </tr>
            <tr>
                <td class="label">GPS Item Information</td>
                <td></td>
            </tr>

            <?php if (!empty($gpsDetails)): ?>
            <?php foreach ($gpsDetails as $gps): ?>
            <tr>
                <td class="label">APP NAME</td>
                <td><?php echo htmlspecialchars($gps['app_name']); ?></td>
            </tr>
            <tr>
                <td class="label">USERNAME</td>
                <td><?php echo htmlspecialchars($gps['username']); ?></td>
            </tr>
            <tr>
                <td class="label">SERVER</td>
                <td><?php echo htmlspecialchars($gps['server']); ?></td>
            </tr>
            <tr>
                <td class="label">PASSWORD</td>
                <td><?php echo htmlspecialchars($gps['password']); ?></td>
            </tr>
            <tr>
                <td class="label">SIM</td>
                <td><?php echo htmlspecialchars($gps['sim_no']); ?></td>
            </tr>

            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="2">No GPS details found</td>
            </tr>
            <?php endif; ?>

        </table>
    </div>
    <div class="payment-info">
        <h2>Payment Information</h2>
        <table>
            <tr>
                <td class="label">Sub Total</td>
                <td><?php echo htmlspecialchars($total); ?></td>
            </tr>
            <tr>
                <td class="label">Cash</td>
                <td><?php echo htmlspecialchars($paid); ?></td>
            </tr>
            <tr>
                <td class="label">Balance</td>
                <td><?php echo htmlspecialchars($balance); ?></td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p>Thank you for your purchase!</p>
        <p>Visit us again.</p>
    </div>
</div>
</body>

</html>