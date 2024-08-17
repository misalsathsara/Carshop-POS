<?php
  include 'header1.php';
?>
    <div id="wrapper">
      <!-- Sidebar -->
      <?php include 'wrapper.php';   ?>


      <?php
    include 'db.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Define SQL query
    $sql = "SELECT s.saleid, s.username, s.vehicle_number, s.Total, s.Total_Discount, s.subTotal, s.paid_amount, s.balance, s.Date,
                   c.productName, c.qty, c.item_price, c.selling_price, c.total_price
            FROM pending s
            INNER JOIN cart c ON c.saleid = s.saleid
            ORDER BY s.Date DESC";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch all rows
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $groupedRows = [];

        foreach ($rows as $row) {
            $id = $row['saleid'];

            if (!isset($groupedRows[$id])) {
                $groupedRows[$id] = [
                    'id' => $row['saleid'],
                    'username' => $row['username'],
                    'vehicleNumber' => $row['vehicle_number'],
                    'Total' => $row['Total'],
                    'Total_Discount' => $row['Total_Discount'],
                    'subTotal' => $row['subTotal'],
                    'paid_amount' => $row['paid_amount'],
                    'balance' => $row['balance'],
                    'Date' => $row['Date'],
                    'products' => [],
                    'quantities' => [],
                    'item_prices' => [],
                    'sell_prices' => [],
                    'total_prices' => []
                ];
            }

            // Add product details to the groupedRows array
            $groupedRows[$id]['products'][] = $row['productName'];
            $groupedRows[$id]['quantities'][] = $row['qty'];
            $groupedRows[$id]['item_prices'][] = $row['item_price'];
            $groupedRows[$id]['sell_prices'][] = $row['selling_price'];
            $groupedRows[$id]['total_prices'][] = $row['total_price'];
        }

        $stmt->close();
    } else {
        // Output SQL error
        echo 'Error preparing SQL statement: ' . $conn->error;
    }
    ?>

          <div id="content-wrapper">
            <div class="container-fluid">
              <!-- Breadcrumbs-->
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active">Sales</li>
              </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header bg-primary text-white">
              <i class="fa fa-table"></i>
              Recorded Sales
            </div>
            

<style>
          .container {
            width: 100%;
            background: #fff;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .row {
            
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .row > * {
            margin: 10px;
           
        }
        .search-bar {
            flex: 1;
            max-width: 350px;
        }
        .search-bar input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .search-bar input:focus {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            outline: none;
        }
        .button-group {
            display: flex;
            flex-wrap: wrap;
        }
        .button-group button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .button-group button.today {
            background-color: #007bff;
            color: #fff;
        }
        .button-group button.reset {
            background-color: #ff5722;
            color: #fff;
        }
        .button-group button.weekly {
            background-color: #28a745;
            color: #fff;
        }
        .button-group button.monthly {
            background-color: #c29b19;
            color: #fff;
        }
        .button-group button.gps {
            background-color: #6c757d;
            color: #fff;
        }
        .button-group button:hover {
            opacity: 0.8;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        }
        .date-select {
            margin: 20px;
            flex: 1;
            max-width: 180px;
            display: row;
            align-items: center;
        }
        .date-select label {
            margin-right: 10px;
            font-weight: bold;
        }
        .date-select input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .date-select input:focus {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            outline: none;
        }

button {
    border: none;
    outline: none;
    cursor: pointer;
}

.payment-section {
    display: flex;
    align-items: center;
    gap: 15px; /* Increased spacing between items */
    padding: 10px; /* Added padding for better spacing */
    background-color: #f8f9fa; /* Light background color */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    max-width: 60%; /* Restrict maximum width */
    margin: 0 auto; /* Center horizontally */
}

.payment-section select,
.payment-section input[type="text"] {
    padding: 8px 12px; /* Padding inside input fields */
    border: 1px solid #ccc; /* Border color */
    border-radius: 4px; /* Rounded corners for inputs */
    font-size: 16px; /* Font size for readability */
}

.payment-section select {
    flex: 1; /* Adjust width as needed */
}

.payment-section h3 {
    margin: 0;
    font-size: 24px; /* Larger font size for emphasis */
    color: #333; /* Darker text color */
}

.payment-section button.update {
    background-color: #007bff; /* Button background color */
    color: #fff; /* Button text color */
    border: none; /* Remove default border */
    padding: 10px 20px; /* Padding inside button */
    border-radius: 4px; /* Rounded corners for button */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 16px; /* Font size for button */
    transition: background-color 0.3s ease; /* Smooth background color transition */
}

.payment-section button.update:hover {
    background-color: #0056b3; /* Darker background color on hover */
}



</style>

<br><br>
<div class="payment-section">
    <select name="" id="">
    <?php
            include 'db.php';
            $query = "SELECT id, Name, credit FROM customer";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['Name']) . '</option>';
                }
            } else {
                echo '<option value="">No customers found</option>';
            }
        ?>
    </select>
    <h3 id="credit">Rs. 00.00</h3>
    <input type="text" name="" id="">
    <button class="update">UPDATE</button>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.querySelector('.payment-section select');
    const creditElement = document.querySelector('#credit');

    selectElement.addEventListener('change', function() {
        const customerId = selectElement.value;

        if (customerId) {
            fetch('getCredit.php?id=' + encodeURIComponent(customerId))
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        creditElement.textContent = 'Rs. ' + data.credit;
                    } else {
                        creditElement.textContent = 'Rs. 00.00';
                    }
                })
                .catch(error => {
                    console.error('Error fetching credit:', error);
                });
        } else {
            creditElement.textContent = 'Rs. 00.00';
        }
    });

    document.querySelector('.payment-section .update').addEventListener('click', function() {
        const customerId = selectElement.value;
        const newCredit = document.querySelector('.payment-section input[type="text"]').value;

        if (customerId && newCredit.trim() !== '') {
            fetch('updateCredit.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'id': customerId,
                    'credit': newCredit
                })
            })
            .then(response => response.text())
            .then(result => {
                //alert(result); // Show a message or handle the response
                location.reload();
            })
            .catch(error => {
                console.error('Error updating credit:', error);
            });
        } else {
            alert('Please select a customer and enter a credit value.');
        }
    });
});
</script>

            <div class="container">
              <div class="row">
                  <div class="search-bar">
                  <input type="text" id="orderIdInput" placeholder="Search vehicle number ...">
                  </div>
                  <div class="button-group">
                      <button class="today"><i class="fas fa-calendar-day"></i> Today</button>
                      <button class="weekly"><i class="fas fa-calendar-week"></i> Weekly</button>
                      <button class="monthly"><i class="fas fa-calendar-month"></i> Monthly</button>
                      <button class="reset"><i class="fas fa-undo-alt"></i> Reload</button>
                      <button class="gps"><i class="fas fa-tachometer-alt"></i>GPS</button>
                  </div>
                  <div class="date-select">
                      <label for="date">Date select:</label>
                      <input type="date" id="selectedDate">
                  </div>
              </div>
          </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SALE-ID</th>
                      <th>Customer</th>
                      <th>Vehicle Number</th>
                      <th>Product</th>
                      <th>Quantity</th>
                      <!-- <th>Item Price</th>
                      <th>Selling Price</th> -->
                      <th>Total</th>
                      <th>Discount</th>
                      <th>Net Total</th>
                      <th>Paid Amount</th>
                      <th>Balance</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>SALE-ID</th>
                      <th>Product</th>
                      <th>Customer</th>
                      <th>Vehicle Number</th>
                      <th>Quantity</th>
                      <!-- <th>Item Price</th>
                      <th>Selling Price</th> -->
                      <th>Total</th>
                      <th>Discount</th>
                      <th>Net Total</th>
                      <th>Paid Amount</th>
                      <th>Balance</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach ($groupedRows as $groupedRow): ?>
        <tr>
            <td style="font-size:2vh;">
                <?php echo htmlspecialchars($groupedRow['id']); ?>
                <br>
                <?php
                // Check if GPS button should be displayed
                $customizeSql = "SELECT saleid FROM gps WHERE saleid = ?";
                if ($customizeStmt = $conn->prepare($customizeSql)) {
                    $customizeStmt->bind_param('i', $groupedRow['id']);
                    $customizeStmt->execute();
                    $customizeResult = $customizeStmt->get_result();
                    
                    if ($customizeResult->num_rows > 0): ?>
                        <button class="gps-btn" onclick="openPopup(<?php echo htmlspecialchars($groupedRow['id']); ?>)">GPS</button>
                    <?php endif;
                    $customizeStmt->close();
                } else {
                    // Output SQL error
                    echo 'Error preparing SQL statement for GPS check: ' . $conn->error;
                }
                ?>
            </td>
            <td ><?php echo htmlspecialchars($groupedRow['username']); ?></td>
            <td><?php echo htmlspecialchars($groupedRow['vehicleNumber']); ?></td>
            <td>
                <?php foreach ($groupedRow['products'] as $index => $product): ?>
                    <?php echo htmlspecialchars($product); ?><?php echo ($index < count($groupedRow['products']) - 1) ? '<br>' : ''; ?>
                <?php endforeach; ?>
            </td>
            <td>
                <?php foreach ($groupedRow['quantities'] as $index => $quantity): ?>
                    <?php echo htmlspecialchars($quantity); ?><?php echo ($index < count($groupedRow['quantities']) - 1) ? '<br>' : ''; ?>
                <?php endforeach; ?>
            </td>
            <!-- <td>
                <?php foreach ($groupedRow['item_prices'] as $index => $price): ?>
                    <?php echo htmlspecialchars($price); ?><?php echo ($index < count($groupedRow['item_prices']) - 1) ? '<br>' : ''; ?>
                <?php endforeach; ?>
            </td>
            <td>
                <?php foreach ($groupedRow['sell_prices'] as $index => $price): ?>
                    <?php echo htmlspecialchars($price); ?><?php echo ($index < count($groupedRow['sell_prices']) - 1) ? '<br>' : ''; ?>
                <?php endforeach; ?>
            </td> -->
            <td>
                <?php foreach ($groupedRow['total_prices'] as $index => $price): ?>
                    <?php echo htmlspecialchars($price); ?><?php echo ($index < count($groupedRow['total_prices']) - 1) ? '<br>' : ''; ?>
                <?php endforeach; ?>
            </td>
            <td><?php echo htmlspecialchars($groupedRow['Total_Discount']); ?></td>
            <td><?php echo htmlspecialchars($groupedRow['subTotal']); ?></td>
            <td><?php echo htmlspecialchars($groupedRow['paid_amount']); ?></td>
            <td><?php echo htmlspecialchars($groupedRow['balance']); ?></td>
            <td><?php echo htmlspecialchars($groupedRow['Date']); ?></td>
            <td><button class="view" onclick="viewsale('<?php echo $groupedRow['id']; ?>')">View</button></td>
            </tr>
    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            
          </div>

        </div>
        <br><br><br>
        <script>
function viewsale(id) {
    window.location.href = 'pastbill.php?id=' + encodeURIComponent(id);
}
</script>

        <style>
         .view {
    background-color: #007BFF; /* Blue background */
    color: white; /* White text */
    padding: 8px 16px; /* Padding for size */
    border-radius: 4px; /* Rounded corners */
    font-size: 16px; /* Font size */
    font-weight: bold; /* Bold text */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

.view:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

.view:focus {
    outline: 2px solid #0056b3; /* Outline for accessibility */
}
 
        .gps-btn {
            background-color: rgb(255, 0, 0);
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .gps-btn:hover {
            background-color: rgb(170, 4, 4);
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        }

 /* Popup container */
 .popup-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.5s;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
            animation: slideIn 0.5s;
        }

        .popup-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .popup-table {
            width: 100%;
            border-collapse: collapse;
        }

        .popup-table th, .popup-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .popup-table th {
            background-color: #f2f2f2;
        }

        #popup-title{
        font-weight:bold;
        font-size:20px;
        text-align:center;
    }
    .box-count{
        font-size:16px;
        margin-right:70%;
        color:red;
    }

    .close-btn {
            color: #aaa;
            font-size: 36px;
            font-weight: bold;
            margin-left: 95%;;
            top: 0;
            left: 0;
            cursor: pointer;
            }

    .close-btn:hover,
    .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
            }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); }
            to { transform: translateY(0); }
        }
</style>

        <div id="popup" class="popup-container">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <div class="popup-title" id="popup-title"></div>
        <table class="popup-table" id="popup-table">
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>App Name</th>
                    <th>Vehicle Number</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>SIM No</th>
                </tr>
            </thead>
            <tbody id="popup-body"></tbody>
        </table>
    </div>
</div>


<script>
function openPopup(saleId) {
    fetch(`fetch_gps_details.php?saleid=${saleId}`)
        .then(response => response.json())
        .then(data => {
            // Display the order number in the popup title
            document.getElementById('popup-title').innerHTML = `Order Number: ${saleId}`;

            // Get the table body element
            const popupBody = document.getElementById('popup-body');
            popupBody.innerHTML = '';

            // Populate the table with GPS details
            data.forEach(row => {
                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${saleId}</td>
                    <td>${row.app_name}</td>
                    <td>${row.server}</td>
                    <td>${row.username}</td>
                    <td>${row.password}</td>
                    <td>${row.sim_no}</td>
                `;

                popupBody.appendChild(tr);
            });

            // Display the popup
            document.getElementById('popup').style.display = 'flex';
        })
        .catch(error => {
            console.error('Error fetching GPS details:', error);
            alert('An error occurred while fetching GPS details.');
        });
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}


</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const orderIdInput = document.getElementById('orderIdInput');
    const todayBtn = document.querySelector('.today');
    const weeklyBtn = document.querySelector('.weekly');
    const monthlyBtn = document.querySelector('.monthly');
    const resetBtn = document.querySelector('.reset');
    const dateInput = document.getElementById('selectedDate');
    const gpsBtn = document.querySelector('.gps');

    orderIdInput.addEventListener('input', function() {
        filterTableBySaleId(this.value);
    });

    todayBtn.addEventListener('click', function() {
        filterTableByDateRange('today');
    });

    weeklyBtn.addEventListener('click', function() {
        filterTableByDateRange('weekly');
    });

    monthlyBtn.addEventListener('click', function() {
        filterTableByDateRange('monthly');
    });

    resetBtn.addEventListener('click', function() {
        location.reload(); // Reload the page
    });

    dateInput.addEventListener('change', function() {
        filterTableByDate(this.value);
    });

    gpsBtn.addEventListener('click', function() {
        filterTableByGPS();
    });

    // function filterTableBySaleId(saleId) {
    //     const rows = document.querySelectorAll('tbody tr');
    //     rows.forEach(row => {
    //         const cell = row.querySelector('td:first-child');
    //         if (cell && cell.textContent.includes(saleId)) {
    //             row.style.display = '';
    //         } else {
    //             row.style.display = 'none';
    //         }
    //     });
    // }
    function filterTableBySaleId(saleId) {
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        const vehicleNumberCell = row.querySelector('td:nth-child(3)'); // Change this to target the Vehicle Number column
        if (vehicleNumberCell) {
            const vehicleNumber = vehicleNumberCell.textContent.trim();
            if (vehicleNumber.includes(saleId)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}


    function filterTableByDateRange(range) {
        const rows = document.querySelectorAll('tbody tr');
        const today = new Date();
        rows.forEach(row => {
            const dateCell = row.querySelector('td:nth-child(11)');
            const saleDate = new Date(dateCell.textContent);
            let showRow = false;

            switch (range) {
                case 'today':
                    showRow = saleDate.toDateString() === today.toDateString();
                    break;
                case 'weekly':
                    const weekAgo = new Date(today);
                    weekAgo.setDate(today.getDate() - 7);
                    showRow = saleDate >= weekAgo && saleDate <= today;
                    break;
                case 'monthly':
                    const monthAgo = new Date(today);
                    monthAgo.setMonth(today.getMonth() - 1);
                    showRow = saleDate >= monthAgo && saleDate <= today;
                    break;
            }

            row.style.display = showRow ? '' : 'none';
        });
    }

    function filterTableByDate(date) {
        const rows = document.querySelectorAll('tbody tr');
        const selectedDate = new Date(date);
        rows.forEach(row => {
            const dateCell = row.querySelector('td:nth-child(11)');
            const saleDate = new Date(dateCell.textContent);
            row.style.display = saleDate.toDateString() === selectedDate.toDateString() ? '' : 'none';
        });
    }

    function filterTableByGPS() {
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const saleId = row.querySelector('td:first-child').textContent.trim();
            fetch(`check_gps.php?saleid=${saleId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.hasGPS) {
                        row.style.display = ''; // Show the row if it has GPS details
                    } else {
                        row.style.display = 'none'; // Hide the row if it doesn't have GPS details
                    }
                })
                .catch(error => {
                    console.error('Error checking GPS details:', error);
                    row.style.display = 'none'; // Hide the row if there is an error
                });
        });
    }
});
</script>













        <!-- Sticky Footer -->
        <?php
            include 'footer.php';
         ?>
         

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
      
      <!-- Modals -->
      <?php
        include 'modals.php';
      ?>

    <script src="js/jquery.min.js"></>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <script src="js/rc-pos.min.js"></script>
    <script src="js/datatables-demo.js"></script>
    <script src="js/chart-area-demo.js"></script>
  </body>
</html>
