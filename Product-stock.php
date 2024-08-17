<?php
  include 'header1.php';
?>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include 'wrapper.php';   ?>
    <?php
        include 'db.php';
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Customer</title>
        <style>
            .cus-form {
                max-width: 600px;
                margin: 30px auto;
                padding: 30px;
                background: #ffffff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: box-shadow 0.3s ease;
            }

            .cus-form:hover {
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                font-weight: 500;
                margin-bottom: 8px;
                color: #333;
            }

            .form-group input {
                width: 100%;
                padding: 12px;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 16px;
                box-sizing: border-box;
                transition: border-color 0.3s ease;
            }

            .form-group input:focus {
                border-color: #007bff;
                outline: none;
            }

            .btn {
                display: inline-block;
                padding: 12px 24px;
                font-size: 16px;
                font-weight: 600;
                text-align: center;
                color: #fff;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .btn-primary {
                background-color: #007bff;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }

            .btn-danger {
                background-color: #dc3545;
            }

            .btn-danger:hover {
                background-color: #c82333;
            }

            .text-center {
                text-align: center;
            }

            table {
                margin-top: 70px;
                width: 100%;
                height: 100%;
                border-collapse: collapse;
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
              
            }

            thead th {
                background-color: #4CAF50;
                color: white;
                padding: 12px;
                text-align: left;
                font-weight: bold;
                border-bottom: 2px solid #ddd;
            }

            tbody td {
                padding: 12px;
                border-bottom: 1px solid #ddd;
                color: #333;
            }

            /* Set a fixed height for table rows */
            tbody tr {
                height: 50px !important;
                /* Adjust the height as needed */
            }

            tbody td {
                vertical-align: middle;
                /* Center content vertically */
            }

            /* Ensure that content doesn't overflow and is handled properly */
            tbody td {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            tbody tr:hover {
                background-color: #f1f1f1;
            }

            .edit-btn {
                background-color: #007bff;
                color: #fff;
                padding: 6px 12px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                text-decoration: none;
            }

            .delete-btn {
                background-color: red;
                color: #fff;
                padding: 6px 12px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                text-decoration: none;
            }

            .delete-btn:hover {
                background-color: rgb(165, 0, 0);
                color: white;
            }

            .edit-btn:hover {
                background-color: #0056b3;
                color: white;
            }

            button[type="submit"] {
                background-color: #28a745;
                /* Green background */
                color: white;
                padding: 8px 20px;
                border: none;
                border-radius: 5px;
                font-size: 14px;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.3s ease, transform 0.2s ease;
                margin-right: -20px;
                margin-left: 10px;
            }

            button[type="submit"]:hover {
                background-color: #218838;
                /* Darker green on hover */
            }

            button[type="submit"]:active {
                background-color: #1e7e34;
                /* Even darker green when clicked */
                transform: scale(0.98);
                /* Slightly shrink the button when clicked */
            }

            button[type="submit"]:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(72, 180, 97, 0.5);
                /* Light green focus ring */
            }

       

       
            .search-container {
                max-width: 50%;
                margin: 20px auto;
                text-align: center;
              
            }

            .search-bar-input {
                width: 100%;
                padding: 12px 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                font-size: 16px;
                color: #333;
                transition: border-color 0.3s ease, box-shadow 0.3s ease;
            }

            .search-bar-input:focus {
                border-color: #007bff;
                box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
                outline: none;
            }

            .search-bar-input::placeholder {
                color: #888;
                font-size: 14px;
            }

            .input-group-overlay {
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                width: 100%;
            }


        </style>
    </head>

    <body>


   
            <div class="search-container">
            <div class="input-group-overlay input-group-merge input-group-custom" style="position:absolute; width: 15%; ">
                <div class="input-group-prepend" style="position:absolute;">                 
                </div>
                <input id="search" autocomplete="off" type="text" name="search" class="form-control search-bar-input"
                    placeholder="Search by code or name" aria-label="Search here">
            </div>
        </div> 
    
        
        <table id="dataTable" style="margin-top: 80px;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Current Stock</th>
                    <th>Limit Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming $conn is your MySQL connection
                $sql = "SELECT id, name, stock, limit_stock FROM products";
                $customers_result = mysqli_query($conn, $sql);
        
                if ($customers_result && mysqli_num_rows($customers_result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($customers_result)): ?>
                        <?php 
                        // Determine the row highlight class and warning message
                        $highlight_class = '';
                        $warning_message = '';
                        if ($row['stock'] <= $row['limit_stock']) {
                            $highlight_class = 'highlight-red'; // Red highlight for stock <= limit stock
                            $warning_message = 'Stock is low.';
                        } else {
                            $highlight_class = 'highlight-green'; // Green highlight for limit stock > stock
                        }
                        ?>
                        <tr class="<?php echo htmlspecialchars($highlight_class); ?>">
                            <td class="name-cell">
                                <?php echo htmlspecialchars($row['name']); ?>
                                <?php if ($warning_message): ?>
                                    <div class="warning-message">
                                        <?php echo htmlspecialchars($warning_message); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row['stock']); ?>
                            </td>
                            <td>
                                <!-- Input box for limit_stock -->
                                <form method="POST" action="update_limit_stock.php">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <input type="number" name="limit_stock"
                                        value="<?php echo htmlspecialchars($row['limit_stock']); ?>" />
                                    <button type="submit">Save</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No products found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <script>
        document.getElementById('search').addEventListener('input', function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTable tbody tr');
        
            rows.forEach(function(row) {
                var nameCell = row.querySelector('.name-cell').textContent.toLowerCase();
                if (nameCell.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        </script>
        
        <style>
            .highlight-red {

                color: white;
                /* Text color for readability */
            }

            .warning-message {
                /* Warning message color */
                font-weight: bold;
                font-size: 0.9em;
                /* Optional: smaller font size */
                margin-top: 5px;
                /* Optional: space above the warning message */
            }
        </style>




    </body>

    </html>