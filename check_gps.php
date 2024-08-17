<?php
include 'db.php';

// Get the sale ID from the query string
$saleId = isset($_GET['saleid']) ? intval($_GET['saleid']) : 0;

$response = ['hasGPS' => false];

if ($saleId > 0) {
    // Prepare a statement to check for GPS data associated with the sale ID
    $sql = "SELECT COUNT(*) as count FROM gps WHERE saleid = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $saleId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();

        if ($count > 0) {
            $response['hasGPS'] = true;
        }

        $stmt->close();
    } else {
        // Output SQL error
        echo json_encode(['error' => 'Error preparing SQL statement: ' . $conn->error]);
        exit;
    }
}

// Return the response as JSON
echo json_encode($response);
?>
