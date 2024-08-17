<?php
include 'db.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$credit = isset($_POST['credit']) ? $_POST['credit'] : '';

if ($id > 0 && !empty($credit)) {
    // Validate and sanitize the credit value
    $credit = filter_var($credit, FILTER_VALIDATE_FLOAT);
    
    if ($credit !== false) {
        // Begin transaction to ensure data integrity
        mysqli_begin_transaction($conn);
        
        try {
            // Retrieve the current credit value
            $query = "SELECT credit FROM customer WHERE id = ?";
            if ($stmt = mysqli_prepare($conn, $query)) {
                mysqli_stmt_bind_param($stmt, 'i', $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $current_credit);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
                
                // Check if current credit is available
                if ($current_credit !== null) {
                    // Calculate the new balance
                    $new_credit = $current_credit - $credit;
                    
                    // Prepare and execute the update query
                    $update_query = "UPDATE customer SET credit = ? WHERE id = ?";
                    if ($update_stmt = mysqli_prepare($conn, $update_query)) {
                        mysqli_stmt_bind_param($update_stmt, 'di', $new_credit, $id);
                        if (mysqli_stmt_execute($update_stmt)) {
                            // Commit transaction
                            mysqli_commit($conn);
                            echo 'Credit updated successfully. New balance: ' . number_format($new_credit, 2);
                        } else {
                            throw new Exception('Error updating credit: ' . mysqli_error($conn));
                        }
                        mysqli_stmt_close($update_stmt);
                    } else {
                        throw new Exception('Error preparing update query: ' . mysqli_error($conn));
                    }
                } else {
                    throw new Exception('Customer not found.');
                }
            } else {
                throw new Exception('Error preparing select query: ' . mysqli_error($conn));
            }
        } catch (Exception $e) {
            // Rollback transaction on error
            mysqli_rollback($conn);
            echo $e->getMessage();
            
        }
    } else {
        echo 'Invalid credit value.';
    }
} else {
    echo 'Invalid input.';
   
}
?>
