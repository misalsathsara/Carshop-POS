<?php
$server_name = "localhost:8889";
$username = "root";
$password = "root";
$db_name = "carshop_db";

// $server_name = "localhost:3308";
// $username = "root";
// $password = "";
// $db_name = "carshop_db";

$conn = new mysqli($server_name, $username, $password, $db_name);

if($conn->connect_error){
    die('Error: ' . $conn->connect_error);

}

?>