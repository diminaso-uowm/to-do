<?php
include 'config.php';
include 'auth.php';
session_start();
if (isset($_POST['submit'])) {
    $username=$_POST['username'];
	$password=$_POST['password'];
    $check="SELECT username, password FROM users WHERE username=?";
    $res=mysqli_prepare($conn, $check);
	$res->bind_param("s", $username);
	$res->execute();
    $res->store_result();
    $res->bind_result($uu, $pp);
    if (!empty($username) AND !empty($password)) {
        if ($res->num_rows == 1) {
            $res->fetch();
            if (password_verify($password, $pp)) {
                $_SESSION['username'] = $uu;
                $username = "";
                $_POST['password'] = "";
                header('Location: app');
                exit;
            }
            else {
                $_SESSION = [];
                session_destroy();
                echo "<script>alert('Wrong Password, please try again')</script>";
                $username = "";
                $_POST['password'] = "";
            }
        }
        else {
            $_SESSION = [];
            session_destroy();
            echo "<script>alert('User not found. Check your Username or create a new account')</script>";
            $username = "";
            $_POST['password'] = "";
        }
    }
    else {
        $_SESSION = [];
        session_destroy();
        echo "<script>alert('Username and Password cannot be blank')</script>";
        $username = "";
        $_POST['password'] = "";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<title>Sign In | To Do</title>
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="to-do-title">
			<h1 id="title">To Do</h1>
		</div>
		<div class="client-area">
			<div class="client-header">
				<h2>Sign In</h2>
			</div>
            <form method="POST" class="login">
                <label for="username">Username</label>
			    <br>
                <input type="text" name="username" id="username" placeholder="Enter your Username" autocomplete="username" required/>
                <br>
                <label for="password">Password</label>
			    <br>
                <input type="password" name="password" id="password" placeholder="Enter you Password" autocomplete="password" required/>
                <br>
                <button name="submit" class="login-btn">Login</button>
            </form>
            <a href="register.php"><p class="link">Create new account</p></a>
		</div>
	</div>
</body>
</html>