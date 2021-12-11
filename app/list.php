<?php
include '../config.php';
session_start();
include 'auth.php';
$list_action = "SELECT * FROM list";
$res = mysqli_prepare($conn, $list_action);
$res->execute();
$res->bind_result($id, $task, $user);
while ($list = $res->fetch()) {    
?>

<tr>
<style>
thead {
    display: table-header-group !important;
}
</style>
    <td class="counter text-center"></td>
    <td class="list text-center"><?php echo $task; ?></td>
    <td class="text-center"><?php echo $user; ?></td>
    <td class="pointer text-center" id="delete-btn" title="Mark as done" data-id="<?php echo $id; ?>"><i class="fas fa-check" style="font-size: 26px;"></i></td>
</tr>

<?php    
}
if (empty($list)) {
    echo "<h3>No tasks found!</h3>";
?>
    <style>
        thead {
            display: none;
        }
    </style>
<?php
}
$conn->close();
?>