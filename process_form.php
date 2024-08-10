<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $app_name = isset($_POST['app_name']) ? htmlspecialchars($_POST['app_name']) : '';
    $server = isset($_POST['server']) ? htmlspecialchars($_POST['server']) : '';
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
    $sim_no = isset($_POST['sim_no']) ? htmlspecialchars($_POST['sim_no']) : '';

    $_SESSION['details'] = array(
        'app_name' => $app_name,
        'server' => $server,
        'username' => $username,
        'password' => $password,
        'sim_no' => $sim_no
    );

    echo 'Session created successfully';
}
?>