
<?php
  include 'header1.php';
?>
    <div id="wrapper">
      <!-- Sidebar -->
      <?php include 'wrapper.php';   ?>
      <?php
include 'db.php';

// Handle form submission for updating or deleting customer
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        // Update customer
        $id = intval($_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['username']);
        $contact = mysqli_real_escape_string($conn, $_POST['contactNumber']);
        $vehicle = mysqli_real_escape_string($conn, $_POST['vehicleNumber']);

        $update_query = "UPDATE customer SET Name='$name', contact='$contact', vehicle_number='$vehicle' WHERE id=$id";
        if (mysqli_query($conn, $update_query)) {
            echo 'Customer updated successfully.';
        } else {
            echo 'Error updating customer: ' . mysqli_error($conn);
        }
    } elseif (isset($_POST['delete'])) {
        // Delete customer
        $id = intval($_POST['id']);
        $delete_query = "DELETE FROM customer WHERE id=$id";
        if (mysqli_query($conn, $delete_query)) {
            echo 'Customer deleted successfully.';
        } else {
            echo 'Error deleting customer: ' . mysqli_error($conn);
        }
    }
}

// Fetch customer data for edit
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$customer = null;
if ($id > 0) {
    $query = "SELECT * FROM customer WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $customer = mysqli_fetch_assoc($result);
    } else {
        echo 'Customer not found.';
    }
}

// Fetch all customers for listing
$customers_query = "SELECT id, Name, contact, vehicle_number, credit FROM customer";
$customers_result = mysqli_query($conn, $customers_query);
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
    </style>
</head>
<body>

    <?php if ($customer): ?>
        <div class="cus-form">
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($customer['id']); ?>" />
            <div class="form-group">
                <label for="username2">User Name:</label>
                <input type="text" id="username2" name="username" value="<?php echo htmlspecialchars($customer['Name']); ?>" required />
            </div>
            <div class="form-group">
                <label for="contactNumber2">Contact:</label>
                <input type="text" id="contactNumber2" name="contactNumber" value="<?php echo htmlspecialchars($customer['contact']); ?>" required />
            </div>
            <div class="form-group">
                <label for="vehicleNumber2">Vehicle Number:</label>
                <input type="text" id="vehicleNumber2" name="vehicleNumber" value="<?php echo htmlspecialchars($customer['vehicle_number']); ?>" required />
            </div>
            <div class="text-center">
                <button type="submit" name="update" class="btn btn-primary">Update Customer</button>
                <button type="submit" name="delete" class="btn btn-danger">Delete Customer</button>
            </div>
        </form>
        </div>
    <?php else: ?>
        <!-- //<p class="text-center">No customer data available.</p> -->
    <?php endif; ?>

    <!-- <h2 class="text-center">All Customers</h2> -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Vehicle Number</th>
                <th>Credit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($customers_result && mysqli_num_rows($customers_result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($customers_result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Name']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact']); ?></td>
                        <td><?php echo htmlspecialchars($row['vehicle_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['credit']); ?></td>
                        <td><a href="update_customer.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="edit-btn">Edit</a>
                        <a href="update_customer.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="delete-btn">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No customers found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
