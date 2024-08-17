<?php

include 'db.php'; // Include the database connection file

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $lastSaleId = $_GET['id'];
// Fetch the last sale ID
$query = "SELECT * FROM sales WHERE saleid= $lastSaleId";
$result = mysqli_query($conn, $query);

$discount1 = 0;
$netTotal = 0;
if ($row = mysqli_fetch_assoc($result)) {
    $lastSaleId = $row['saleid'];
    $total = $row['subTotal'];
    $paid = $row['paid_amount'];
    $balance = $row['balance'];
    $vehicle_no =  $row['username'];
    $customer_name =  $row['contact'];
    $mobile =  $row['vehicle_number'];
    $numberOfItem =  $row['numberOfItem'];
    $Customer_Profit =  $row['Customer_Profit'];
    $Total_Discount =  $row['Total_Discount'];

    $discount1 = $Customer_Profit - $Total_Discount;

    $netTotal = $total + $Customer_Profit;

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
            max-width: 166mm !important; /* Set the maximum width to fit within B5 paper with margins */
            margin: auto;
            padding: 10mm; /* Adjusted padding for better fit on B5 paper */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: white;
            display: flex;
            flex-direction: column;
            min-height: 240mm; 
        }

        .header {
            position: relative;
            width: 166mm !important;
            display: flex;
            justify-content:end;
            margin-bottom: 20px;
            /* border-bottom: 1px solid #000;  */
            padding-bottom: 10px;
            background-color: #3333334f;
        }

        .header .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 350px;
            height: 120px;
            border-bottom-right-radius: 130px;
            margin-right: 100%;
            margin-right: 20px;
            background-color: #000000;
        }

        .header .logo img {
            margin-top: 6px;
            margin-left: 60px;
            max-width: 180px; /* Adjusted size for better visibility */
        }

        .header .details {
            padding-top: 12px ;
            padding-right: 12px;
            text-align: right;
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
            /* border-bottom: 1px solid #000; */
            padding: 10px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            font-size: 12px; /* Smaller font for better fit */
        }

        .payment-info .label {
            font-weight: bold;
        }
        .header-title{
            margin-top: -30px;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            
            text-align: right;
            
        }
        .header-title h1{
            text-decoration: underline;
            margin-right: 120px;
        }
        .header-title p{
            font-weight: bold;
            margin-left: 10px;
            margin-top: -40px;
        }
        .gps-info .label{
            width: 100px;
            display: flex;
            justify-content: space-between;
        }
        .gps-info .label span{
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="logo2.png" alt="Logo">
            </div>
            <div class="details">
                <h1>AUTO LANKA</h1>
                <p>Car Audio</p>
                <p>Hikkaduwa Road, Gonapinuwala.</p>
                <p>0914552161 / 0761146550</p>
            </div>
        </div>
        <div class="header-title">
                <h1>Sales Invoice</h1>
                <p>Gonapinuwala</p>
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
            <h2 style="font-size: .8rem; text-decoration: underline; letter-spacing: 1px;">GPS Details</h2>
            <table>
                <tr>
                    <td class="label">App Name <span>: </span></td>
                    <td><?php echo htmlspecialchars($gps['app_name']); ?></td>
                </tr>
                <tr>
                    <td class="label">Server <span>: </span></td>
                    <td><?php echo htmlspecialchars($gps['server']); ?></td>
                </tr>
                <tr>
                    <td class="label">Username <span>: </span></td>
                    <td><?php echo htmlspecialchars($gps['username']); ?></td>
                </tr>
                <tr>
                    <td class="label">Password <span>: </span></td>
                    <td><?php echo htmlspecialchars($gps['password']); ?></td>
                </tr>
                <tr>
                    <td class="label">SIM No <span>: </span></td>
                    <td><?php echo htmlspecialchars($gps['sim_no']); ?></td>
                </tr>
            </table>
        </div>
        <?php endif; ?>

<style>
     .footer {
            text-align: center;
            font-size: 10px; 
            padding: 10px;
            margin-top: auto; 
        }
        .footer .label{
            letter-spacing: 1px;
            display: flex;
            /* border: 1px solid red; */
            justify-content: space-between;
            text-align: left;
            
        }

         #footer-table{
        width: 40%;
       }
       #footer-table .footer-value{ 
        text-align: right;
        width: 60%;

       }
       .horizontal-line{
        position: absolute;
        border-top: 1px solid rgb(0, 0, 0);
        height: 1px;
        width: 100%;
       }
</style>


        <div class="footer">
            <div class="payment-info">
                <div style="font-size: .6rem;">Number Of Item - <?php echo htmlspecialchars(number_format($numberOfItem)); ?></div>
                <table id="footer-table">
                    <tr>
                        <td class="label">Gross Total<span>:</span></td>
                        <td class="footer-value"><?php echo htmlspecialchars(number_format($netTotal, 2)); ?></td>
                    </tr>
                    <tr>
                        <td class="label" style="font-size: .6rem; ">Discount<span>:</span></td>
                        <td class="footer-value">-   <?php echo htmlspecialchars(number_format($discount1, 2)); ?></td>
                    </tr>
                    <?php if ($Total_Discount != '0'): ?>
                    <tr>
                        <td class="label" style="font-size: .6rem; ">Extra Discount<span>:</span></td>
                        <td class="footer-value">-   <?php echo htmlspecialchars(number_format($Total_Discount, 2)); ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr style="position: relative;">
                        <td class="horizontal-line"></td>
                    </tr>
                    <tr>
                        <td class="label">Net Total<span>:</span></td>
                        <td class="footer-value"><?php echo htmlspecialchars(number_format($total, 2)); ?></td>
                    </tr>
                    <tr>
                        <td class="label" >Cash<span>:</span></td>
                        <td class="footer-value" ><?php echo htmlspecialchars(number_format($paid, 2)); ?></td>
                    </tr>
                    <tr style="position: relative;">
                        <td class="horizontal-line"></td>
                    </tr>
                    <tr>
                        <td class="label">Balance<span>:</span></td>
                        <td class="footer-value"><?php echo htmlspecialchars(number_format($balance, 2)); ?></td>
                    </tr>
                    <tr style="position: relative;">
                        <td class="horizontal-line"></td>
                    </tr>
                    <tr style="position: relative;">
                        <td class="horizontal-line"></td>
                    </tr>
                </table>
            </div>
            <p style="font-size: .6rem; font-weight: bold;">I, as the purchaser or authorized representative, hereby confirm that I have carefully read and understood all the terms and have received the goods in the expected condition.</p>
            <p style="text-align: right; margin-top: 55px;">........................................ <span style="display: block;">Authorised by</span></p>
            <p>Thank you for your purchase!</p>
            <p>Terms and conditions apply.</p>
        </div>
    </div>
</body>

</html>