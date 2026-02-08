<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "sdc310l_project";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>