<?php
include('config.php');
if(isset($_POST['username'])){
	$username=mysqli_real_escape_string($conn,$_POST['username']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	$sql="SELECT * FROM user WHERE username='$username' and pass='$password'";
	$result = mysqli_query($conn,$sql);
	// print_r($result);
	$count=mysqli_num_rows($result);
	if($count == 1){
		$_SESSION['login_user']=$username;
		header("location: index.php");

	}else{
		$error = "*Your Login Name or Password is invalid*";
	}
	
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="login/images/icons/favicon.ico" />

	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">

	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">

	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">

	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">

	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">

</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('login/images/Halongbay.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" autocomplete="off">
					<span class="login100-form-logo">
						<i class="zmdi">
							<img src="login/images/cath-logo.png" style="width: 100px;height: 100px;">
						</i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Sign in
					</span>

					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div style = "font-size:15px; color:#F0F8FF; margin-top:10px"><?php echo $error; ?></div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit" value="sign in">
							Sign In
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#" onClick="parent.location='signup.php'">
							Create new account?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>


	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="vendor/animsition/js/animsition.min.js"></script> 

	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="vendor/select2/select2.min.js"></script>

	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>

	<script src="vendor/countdowntime/countdowntime.js"></script>

	<script src="js/main.js"></script>

</body>

</html>