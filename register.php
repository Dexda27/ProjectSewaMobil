<?php

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}

	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p style="font-size:2em;font-weight:850;">REGISTER</p>
            <div class="input-group"><input type="text" placeholder="UserName" name="username"
                    value="<?php echo $username;?>"></div>

            <div class="input-group"><input type="text" placeholder="Email" name="email" value="<?php echo $email;?>">
            </div>

            <div class="input-group"><input type="password" placeholder="Password" name="Password"
                    value="<?php echo $_POST['password']?>" required></div>

            <div class="input-grup"><input type="password" placeholder="ConfirmPasword" name="Cppassword"
                    value="<?php echo $_POST['password']?>" required></div>

            <div class="input-group"><button name="submit" class="btn">Register</button></div>

            <p class="login-register-text">Have an Account ?
                <a href="index.php">Log In</a>
            </p>
        </form>
    </div>
</body>

</html>