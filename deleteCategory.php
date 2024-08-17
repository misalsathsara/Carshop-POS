<?php
// Include your database connection
require_once 'db.php'; // Adjust the path as necessary

if (isset($_GET['category'])) {
    $categoryName = $_GET['category'];

    // Sanitize the input to prevent SQL injection
    $categoryName = mysqli_real_escape_string($conn, $categoryName);

    // Begin a transaction
    mysqli_begin_transaction($conn);

    try {
        // Delete the category from the category table
        $deleteCategoryQuery = "DELETE FROM category WHERE name = ?";
        $stmt = mysqli_prepare($conn, $deleteCategoryQuery);
        mysqli_stmt_bind_param($stmt, 's', $categoryName);
        mysqli_stmt_execute($stmt);

        // Check if the category was deleted
        if (mysqli_stmt_affected_rows($stmt) === 0) {
            throw new Exception('Category not found or could not be deleted.');
        }

        // Update related products to "No category"
        $updateProductsQuery = "UPDATE products SET category = 'No category' WHERE category = ?";
        $stmt = mysqli_prepare($conn, $updateProductsQuery);
        mysqli_stmt_bind_param($stmt, 's', $categoryName);
        mysqli_stmt_execute($stmt);

        // Check if products were updated
        if (mysqli_stmt_affected_rows($stmt) === 0) {
            // throw new Exception('No products found or could not be updated.');
            
        }

        // Commit the transaction
        mysqli_commit($conn);

        // Redirect or show a success message
        header("Location: product-brands.php"); // Adjust the redirection as necessary
        exit;
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        mysqli_rollback($conn);

        // Log or handle the error
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Category name is required.";
}
?>
