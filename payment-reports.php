<?php
  include 'header1.php';
?>

    <div id="wrapper">
      <!-- Sidebar -->
      <?php include 'wrapper.php';   ?>

      <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Payment Reports</li>
          </ol>
          <!-- Icon Cards-->
          <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php'; 

// Initialize variables
$todayProfit = 0;
$weeklyProfit = 0;
$monthlyProfit = 0;

// Calculate today's profit
$todayDate = date('Y-m-d');
$sql = "SELECT SUM(profit) FROM profit WHERE DATE(date) = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('s', $todayDate);
    $stmt->execute();
    $stmt->bind_result($todayProfit);
    $stmt->fetch();
    $stmt->close();
}

// Calculate weekly profit (last 7 days including today)
$startOfWeek = date('Y-m-d', strtotime('-6 days')); // 7 days back from today
$endOfWeek = $todayDate; // Today
$sql = "SELECT SUM(profit) FROM profit WHERE DATE(date) BETWEEN ? AND ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('ss', $startOfWeek, $endOfWeek);
    $stmt->execute();
    $stmt->bind_result($weeklyProfit);
    $stmt->fetch();
    $stmt->close();
}

// Calculate monthly profit (last 30 days including today)
$startOfMonth = date('Y-m-d', strtotime('-29 days')); // 30 days back from today
$endOfMonth = $todayDate; // Today
$sql = "SELECT SUM(profit) FROM profit WHERE DATE(date) BETWEEN ? AND ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('ss', $startOfMonth, $endOfMonth);
    $stmt->execute();
    $stmt->bind_result($monthlyProfit);
    $stmt->fetch();
    $stmt->close();
}


?>

<style>

  .search-container {
    margin-bottom: 20px !important;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
    justify-content:baseline;
  }

  .search-container button,
  .search-container input[type="date"],
  .search-container form {
    display: inline-block;
    vertical-align: middle;
    margin-right: 10px;
  }

  .search-container button {
    margin-left: 15px;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    font-size: 14px;
  }

  .search-container button:hover {
    background-color: #0056b3;
  }

  .search-container button[name="today"] {
    background-color: #28a745;
  }

  .search-container button[name="today"]:hover {
    background-color: #218838;
  }

  .search-date {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.493); 
    width: 100%;
    margin-left: 50%;
    display: inline-block;
    vertical-align: middle;
    padding: 5px;
    border-radius: 12px;
  }

  .search-date input[type="date"] {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
  }

  .search-date label {
    /* border: 1px solid #ff0000;  */
    margin-right: 2px;
    font-size: 14px;
  }
</style>

</style>
      
                  <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-3">
                      <div class="card o-hidden h-100">
                        <div class="card-header bg-primary text-white">
                          <h1>Last Month</h1>
                        </div>
                        <div class="card-body">
                          <div class="card-body-icon text-white">
                            <i class="fa fa-fw fa-shopping-cart"></i>
                          </div>
                          <div class="card-text text-center">
                          <span class="display-3"><strong style="font-size: 2rem;">Rs. <?php echo number_format($monthlyProfit, 2); ?></strong></span>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card o-hidden h-100">
                          <div class="card-header bg-primary text-white">
                            <h1>Last Week</h1>
                          </div>
                          <div class="card-body">
                            <div class="card-body-icon text-white">
                              <i class="fa fa-fw fa-rocket"></i>
                            </div>
                            <div class="card-text text-center">
                            <span class="display-3"><strong style="font-size: 2rem;">Rs. <?php echo number_format($weeklyProfit, 2); ?></strong></span>
                            </div>
                          </div>
                        </div>
                        </div>
                    <div class="col-xl-6 col-sm-12 mb-3">
                      <div class="card o-hidden h-100">
                        <div class="card-header bg-dark text-white">
                          <h1>Today Profit</h1>
                        </div>
                        <div class="card-body">
                          <div class="card-body-icon text-white">
                            <i class="fa fa-fw fa-dollar"></i>
                          </div>
                          <div class="card-text text-center">
                          <span class="display-3"><strong>Rs. <?php echo number_format($todayProfit, 2); ?></strong></span>
                          </div>
                        </div>
                      </div>
                      </div>
                          </div>
                          <div class="row">
                            <h3></h3>
                          </div>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header bg-primary text-white">
              <i class="fa fa-table"></i>
              Account Details
            </div>
            <div class="card-body">
                <div class="search-container">
                  <button id="refresh" name="refresh">Refresh</button>
                  <button id="today" name="today">Today</button>
                  <form name="date-form" id="date-form">
                      <div class="search-date">
                          <input type="date" name="start_date" id="start_date">
                          <label for="start_date">Start Date</label>
                          <input type="date" name="end_date" id="end_date" style="margin-left: 15px;">
                          <label for="end_date">End Date</label>
                          <button type="submit">Filter</button>
                      </div>
                  </form>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sale ID</th>
                      <th>Profit</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sale ID</th>
                      <th>Profit</th>
                      <th>Date</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    // Get the date filter values from query parameters
                    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
                    $filter_today = isset($_GET['filter']) && $_GET['filter'] == 'today';

                    // Prepare SQL query based on filters
                    if ($filter_today) {
                        $sql = "SELECT * FROM profit WHERE DATE(date) = CURDATE()";
                    } elseif ($start_date && $end_date) {
                        $sql = "SELECT * FROM profit WHERE DATE(date) BETWEEN '$start_date' AND '$end_date'";
                    } else {
                        $sql = "SELECT * FROM profit";
                    }

                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['saleid']) . '</td>';
                                echo '<td class="text-danger">' . htmlspecialchars($row['profit']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['date']) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3">No records Found!</td></tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3">Error fetching records!</td></tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- <div class="card-footer small text-muted">This table shows last 100 Enteries. Check all other enteries <a href="#">here</a>.</div> -->
          </div>
        </div>
        <script>
document.getElementById('refresh').addEventListener('click', function() {
    window.location.href = window.location.pathname; // Reload the page
});

document.getElementById('today').addEventListener('click', function() {
    window.location.href = window.location.pathname + '?filter=today'; // Reload the page with filter
});

document.getElementById('date-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get form values
    const startDate = document.getElementById('start_date').value;
    const endDate = document.getElementById('end_date').value;

    // Build the URL with query parameters
    let url = window.location.pathname + '?start_date=' + encodeURIComponent(startDate) + '&end_date=' + encodeURIComponent(endDate);

    // Redirect to the new URL
    window.location.href = url;
});
</script>
        <br><br><br>
        <?php
            include 'footer.php';
         ?>
         
      </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
      
      <!-- Modals -->
      <?php
        //include 'modals.php';
      ?>

    <script src="js/jquery.min.js"></script>
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
