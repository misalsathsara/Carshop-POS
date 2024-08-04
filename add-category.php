<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = htmlspecialchars($_POST['category_name']);

    $stmt = $conn->prepare("INSERT INTO category (name) VALUES (?)");
    $stmt->bind_param("s", $category_name);

    if ($stmt->execute()) {
        header('location:product-brands.php');
        exit();
    } else {
        header('location:404.php') . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
