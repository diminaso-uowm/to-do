<?php
include 'config.php';
include 'auth.php';
session_start();
if (isset($_POST['submit'])) {
    $check_username = "SELECT * FROM users WHERE username=?";
    $username_exist=mysqli_prepare($conn, $check_username);
	$username_exist->bind_param("s", $u);
    $u=$_POST['username'];
    $e=$_POST['email'];
    $p=$_POST['password'];
    $cp=$_POST['confirm_password'];
	$username_exist->execute();
    if (!empty($u) AND !empty($e) AND !empty($p) AND !empty($cp)) {
        if (strlen($u) < 100 AND strlen($e) < 100 AND strlen($p) > 7 AND strlen($p) < 100 AND strlen($cp) > 7 AND strlen($cp) < 100) {
            if (!$username_exist->fetch() > 0) {
                if ($p == $cp) {
                    $create_user = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                    $new_user=mysqli_prepare($conn, $create_user);
		            $new_user->bind_param("sss", $uu, $ee, $pp);
	                $uu=$_POST['username'];
                    $ee=$_POST['email'];
                    $pp=$_POST['password'];
                    $pp=password_hash($pp, PASSWORD_DEFAULT);
                    $new_user->execute();
                    if ($new_user) {
                        $username = "";
                        $email = "";
                        $_POST['password'] = "";
                        $_POST['confirm_password'] = "";
                        header("Location: .");
                        exit;
                    }
                    else {
                        echo "<script>alert('Error on creating user')</script>";
                    }
                }
                else {
                    echo "<script>alert('The Password and the Confirmation Password are different')</script>";
                }
            }
            else { 
                echo "<script>alert('Username already on use, please choose another one')</script>";
            }
        }
        else {
            echo "<script>alert('Not acceptable password or error with fields length. Please read titles of input fields')</script>";
        }
    }
    else {
        echo "<script>alert('All fields are required')</script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<title>Sign Up | To Do</title>
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
				<h2>Sign Up</h2>
			</div>
            <form method="POST" id="register" class="register">
                <label for="username">Username *</label>
			    <br>    
                <input type="text" name="username" id="username" placeholder="Choose username (max: 100)" autocomplete="username" title="Enter a username" maxlength="100" required >
                <br>
                <label for="email">Email *</label>
                <br>
                <input type="email" name="email" id="username" placeholder="Your email (max: 100)" autocomplete="email" title="Enter your email" maxlength="100" required >
                <br>
                <label for="password">Password *</label>
                <br>
                <input type="password" name="password" id="password" placeholder="A strong password (min: 8)" title="Password must be at least 8 characters in length (max 100)" minlength="8" maxlength="100" required >
                <br>
                <label for="confirm_passowrd">Confirm Password *</label>
                <br>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Re-enter strong password" title="Re-enter your password, make sure it is the same password" minlength="8" maxlength="100" required >
                <br>
                <button class="login-btn" type="submit" name="submit">Register</button>
            </form>
            <a href="."><p class="link">Login to your account</p></a>
		</div>
	</div>
</body>
</html>