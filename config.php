<?php

$host = "HOST";
$db_username = "DATABASE_USERNAME";
$database = "DATABASE_NAME";
$db_password = "DATABASE_PASSWORD";

$conn = mysqli_connect($host, $db_username, $db_password, $database);

if (!$conn) {
    echo "<script>alert('Failed to connect to database')</script>";
}

?>