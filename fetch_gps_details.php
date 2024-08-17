<?php
// Include the database connection file
include 'db.php';

// Get the saleid from the request
$saleid = isset($_GET['saleid']) ? intval($_GET['saleid']) : 0;

// Prepare SQL query to fetch GPS details
$sql = "SELECT app_name, server, username, password, sim_no FROM gps WHERE saleid = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('i', $saleid);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all rows
    $gpsDetails = $result->fetch_all(MYSQLI_ASSOC);

    // Send JSON response
    echo json_encode($gpsDetails);

    $stmt->close();
} else {
    // Handle errors
    echo json_encode(['error' => 'Error preparing SQL statement: ' . $conn->error]);
}

// Close the database connection
$conn->close();
?>
