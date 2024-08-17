<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pending']) && $_POST['pending'] === 'active') {
        $_SESSION['pending'] = 'active';
        if (isset($_POST['customer'])) {
            $_SESSION['customer'] = $_POST['customer'];
        }
        echo 'Session set: pending=active, customer=' . $_SESSION['customer'];
    } else {
        unset($_SESSION['pending']);
        unset($_SESSION['customer']);
        echo 'Session unset';
    }
}
?>
