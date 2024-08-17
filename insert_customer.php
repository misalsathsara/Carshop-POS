<?php
include 'db.php'; // Ensure this file contains your database connection setup

// Retrieve form data
$username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
$contactNumber = isset($_POST['contactNumber']) ? mysqli_real_escape_string($conn, $_POST['contactNumber']) : '';
$vehicleNumber = isset($_POST['vehicleNumber']) ? mysqli_real_escape_string($conn, $_POST['vehicleNumber']) : '';
$credit = 0.00;
// Validate data
if (!empty($username) && !empty($contactNumber) && !empty($vehicleNumber)) {
    // Prepare and execute the insert query
    $query = "INSERT INTO customer (Name, contact, vehicle_number, credit) VALUES (?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssd', $username, $contactNumber, $vehicleNumber, $credit);
        
        if (mysqli_stmt_execute($stmt)) {
            echo 'Customer added successfully.';
            header('location:customeradd.php');
            exit();
        } else {
            echo 'Error adding customer: ' . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo 'Error preparing query: ' . mysqli_error($conn);
    }
} else {
    echo 'All fields are required.';
}

// Close the database connection
mysqli_close($conn);
?>
