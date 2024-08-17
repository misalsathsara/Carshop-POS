<?php
include 'db.php';
session_start();

if(empty(isset($_SESSION['position']))){
  header('location:login.php');
  exit();
}

include 'header1.php';

// Get total categories count
$sql = "SELECT COUNT(*) AS total FROM category";
$result = $conn->query($sql);
$count = $result->num_rows > 0 ? $result->fetch_assoc()['total'] : 0;

// Get total products count
$sql2 = "SELECT COUNT(*) AS total FROM products";
$result = $conn->query($sql2);
$count1 = $result->num_rows > 0 ? $result->fetch_assoc()['total'] : 0;
?>

<div id="wrapper">
    <?php include 'wrapper.php'; ?>

    <div id="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Overview</li>
            </ol>

            <!-- Summary Cards -->
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-header">
                            <h1>ALL Categories</h1>
                        </div>
                        <div class="card-body">
                            <h1 class="text-center display-3"><strong><?php echo $count; ?></strong></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-header">
                            <h1>All Products</h1>
                        </div>
                        <div class="card-body">
                            <h1 class="text-center display-3"><strong><?php echo $count1; ?></strong></h1>
                        </div>
                    </div>
                </div>
            </div>

            <style>
        .table-header {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #007bff; /* Primary color */
            margin-bottom: 20px;
            margin-top: 40px;
            animation: headerFadeIn 1s ease-in-out forwards;
            opacity: 0;
        }

        @keyframes headerFadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-container {
            max-height: 800px; /* Adjust the max-height as needed */
            overflow-y: auto;
            border: 1px solid #ddd; /* Optional: border for visual separation */
            border-radius: 10px; /* Optional: rounded corners */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            border-radius: 10px;
            opacity: 0;
            animation: tablePopUp 1s ease-in-out forwards;
        }

        @keyframes tablePopUp {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        thead th {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            font-weight: bold;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .highlight-green {
            background-color: #28a745;
            color: white;
        }

        .highlight-red {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
        }

        .warning-message {
            color: #ff4d4d;
            font-weight: bold;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
    <!-- Product Table -->
    <h2 class="table-header">Limit Overview</h2>
    <div class="table-container">
        <table id="productTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Current Stock</th>
                    <th>Limit Stock</th>
                </tr>
            </thead>
            <?php
            $sql = "SELECT id, name, stock, limit_stock FROM products";
            $customers_result = $conn->query($sql);

            if ($customers_result && $customers_result->num_rows > 0): ?>
                <tbody>
                <?php while ($row = $customers_result->fetch_assoc()): ?>
                    <?php 
                        // Determine the row highlight class
                        $highlight_class = $row['stock'] <= $row['limit_stock'] ? 'highlight-red' : 'highlight-green';
                    ?>
                    <tr class="<?php echo htmlspecialchars($highlight_class); ?>">
                        <td>
                            <?php echo htmlspecialchars($row['name']); ?>
                            <?php if ($highlight_class === 'highlight-red'): ?>
                                <div class="warning-message">Stock is low!</div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['stock']); ?></td>
                        <td><?php echo htmlspecialchars($row['limit_stock']); ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">No products found</td>
                </tr>
            <?php endif; ?>
            <?php $conn->close(); ?>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hide all rows initially
            const rows = document.querySelectorAll('#productTable tbody tr');
            rows.forEach(row => {
                if (!row.classList.contains('highlight-red')) {
                    row.style.display = 'none'; // Hide rows that do not have the highlight-red class
                }
            });
        });
    </script>
        </div>
    </div>
</div>
