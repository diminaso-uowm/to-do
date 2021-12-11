<?php
include '../config.php';
session_start();
include 'auth.php';
$delete_action = "DELETE FROM list WHERE id=?";
$res = mysqli_prepare($conn, $delete_action);
$res->bind_param("s", $i);
$i = $_POST['id'];
$res->execute();

if ($res) {
    echo 1;
}
else {
    echo 0;
}
$conn->close();
?>