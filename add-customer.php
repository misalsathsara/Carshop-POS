<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    
    $sql = "INSERT INTO customers (name, mobile) VALUES ('$name', '$mobile')";

    if ($conn->query($sql) === TRUE) {
        header("Location: pos.php");
        exit(); // Make sure to call exit() after header redirection
    } else {
        // Store the error message and redirect to a custom error page
        $error = $sql . "<br>" . $conn->error;
        // Optionally log the error message to a file or database for debugging
        file_put_contents('error_log.txt', $error, FILE_APPEND);
        header("Location: 404.php");
        exit(); // Make sure to call exit() after header redirection
    }

    $conn->close();
}
?>