<?php
include '../config.php';
session_start();
include 'auth.php';
$add_action = "INSERT INTO list (task, user) VALUES (?, ?)";
$res = mysqli_prepare($conn, $add_action);
$res->bind_param("ss", $t, $u);
$t=$_POST['task'];
$u=$_POST['user'];
$res->execute();

if ($res) {
    echo 1;
}
else {
    echo 0;
}
$conn->close();
?>