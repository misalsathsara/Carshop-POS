<?php
include 'db.php';

// Handle form submission for updating or deleting a customer
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        // Update customer
        $id = intval($_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['username']);
        $contact = mysqli_real_escape_string($conn, $_POST['contactNumber']);
        $vehicle = mysqli_real_escape_string($conn, $_POST['vehicleNumber']);

        $update_query = "UPDATE customer SET Name='$name', contact='$contact', vehicle_number='$vehicle' WHERE id=$id";
        if (mysqli_query($conn, $update_query)) {
            header('location:updatecus.php');
            exit();
            //echo '<p class="alert success">Customer updated successfully.</p>';
        } else {
            echo '<p class="alert error">Error updating customer: ' . mysqli_error($conn) . '</p>';
        }
    } elseif (isset($_POST['delete'])) {
        // Delete customer
        $id = intval($_POST['id']);
        $delete_query = "DELETE FROM customer WHERE id=$id";
        if (mysqli_query($conn, $delete_query)) {
            header('location:updatecus.php');
            exit();
            //echo '<p class="alert success">Customer deleted successfully.</p>';
        } else {
            echo '<p class="alert error">Error deleting customer: ' . mysqli_error($conn) . '</p>';
        }
    }
}

// Fetch customer details for editing
$customer_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$customer = null;

if ($customer_id > 0) {
    $query = "SELECT id, Name, contact, vehicle_number FROM customer WHERE id=$customer_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $customer = mysqli_fetch_assoc($result);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            border: none;
            border-radius: 4px;
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

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .alert {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .btn-edit {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-edit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Update Customer</h1>

    <?php if ($customer): ?>
        <form method="POST" action="update_customer.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($customer['id']); ?>" />
            <div class="form-group">
                <label for="username">User Name:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($customer['Name']); ?>" required />
            </div>
            <div class="form-group">
                <label for="contactNumber">Contact:</label>
                <input type="text" id="contactNumber" name="contactNumber" value="<?php echo htmlspecialchars($customer['contact']); ?>" required />
            </div>
            <div class="form-group">
                <label for="vehicleNumber">Vehicle Number:</label>
                <input type="text" id="vehicleNumber" name="vehicleNumber" value="<?php echo htmlspecialchars($customer['vehicle_number']); ?>" required />
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Customer</button>
            <button type="submit" name="delete" class="btn btn-danger">Delete Customer</button>
        </form>
    <?php else: ?>
        <p class="alert error">Customer not found.</p>
    <?php endif; ?>

    
</body>
</html>
