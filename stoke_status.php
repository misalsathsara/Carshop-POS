
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
    height: 50px !important; /* Adjust the height as needed */
}

tbody td {
    vertical-align: middle; /* Center content vertically */
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
        .delete-btn{
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
            color:white;
        }
        .edit-btn:hover {
            background-color: #0056b3;
            color:white;
        }

                button[type="submit"] {
            background-color: #28a745; /* Green background */
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
            background-color: #218838; /* Darker green on hover */
        }

        button[type="submit"]:active {
            background-color: #1e7e34; /* Even darker green when clicked */
            transform: scale(0.98); /* Slightly shrink the button when clicked */
        }

        button[type="submit"]:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(72, 180, 97, 0.5); /* Light green focus ring */
        }

    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Limit Stock</th>
                <!-- <th>Limit Stock</th> -->
              
            </tr>
        </thead>
        <?php
// Assuming $conn is your MySQL connection
$sql = "SELECT id, name, stock, limit_stock FROM products";
$customers_result = mysqli_query($conn, $sql);

if ($customers_result && mysqli_num_rows($customers_result) > 0): ?>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($customers_result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['stock']); ?></td>
            <td>
                <!-- Input box for limit_stock -->
                <form method="POST" action="update_limit_stock.php">
    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
    <!-- <input type="number" name="limit_stock" value="<?php echo htmlspecialchars($row['limit_stock']); ?>" /> -->
    <!-- <button type="submit">Save</button> -->
</form>

            </td>
         
        </tr>
    <?php endwhile; ?>
    </tbody>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No customers found</td>
                        </tr>
                    <?php endif; ?>

        </tbody>
    </table>
</div>
<script>
    function submitForm(productId) {
    // Find the form related to the given product ID and submit it
    const form = document.querySelector(`input[name="product_id"][value="${productId}"]`).closest('form');
    if (form) {
        form.submit();
    }
}
</script>

</body>
</html>
