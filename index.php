<?php

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: welcome.php");
	} else {
		echo "<script>alert('Woops! Email Atau Password anda Salah.')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p style="font-size: 2em; font-weight: 850;">Log In</p>

            <div class="input-group"><input type="email" 
            placeholder="Email" name="email" value="<?php echo $email; ?>"required></div>

            <div class="input-group"><input type="password" 
            placeholder="Password" name="Password" value="<?php echo $_POST['password']; ?>"required></div>


            <div class="input-group"><button name="submit"
            class="btn">LogIn</button></div>

            <p class="login-register-text">Don't Have an Account ?
            <a href="register.php">Register</a>.</p>
        </form>
    </div>
</body>
</html>