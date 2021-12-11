<?php
include '../config.php';
session_start();
include 'auth.php';
$count_action = "SELECT * FROM list";
$res = mysqli_prepare($conn, $count_action);
$res->execute(); 
$res->store_result();
$count = $res->num_rows;
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<title>To Do</title>
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="app.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body>
	<div class="table-title">
		<h1 id="title">To Do</h1>
		<div class="info">
			<input type="text" name="task" id="task" placeholder="What want to do?" maxlength="50" required>
			<input type="hidden" id="user" value="<?php echo $_SESSION['username']; ?>">
			<button id="add-btn" type="submit" title="Click to add your task"><i class="fas fa-plus"></i> Add</button>
			<span class="info2">
				<a href="logout.php"><button id="logout-btn" style="float: right;" type="submit" title="Click to logout"><i class="fas fa-sign-out-alt"></i></button></a>
				<button id="refresh-btn" onclick="window.location.reload();" title="Click to sync tasks" style="float: right; margin-right: 10px;" type="submit"><i class="fas fa-sync-alt"></i></button>
				<button id="pending-tasks" style="float: right; margin-right: 10px;" title="You have <?php echo $count ?> pending tasks"><i class="fas fa-tasks"></i> <?php echo $count ?></button>
				<button id="user" style="float: right; margin-right: 10px; text-transform: initial;" title="You are connected as <?php echo $_SESSION['username']; ?>"><i class="fas fa-user-alt"></i> <?php echo $_SESSION['username']; ?></button>
			</span>
		</div>
	</div>
	<table class="table-fill">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Task</th>
				<th class="text-center">User</th>
				<th class="text-center">Done</th>
			</tr>
		</thead>
	<tbody id="list" class="table-hover">
	</tbody>
	</table>
</body>
</html>