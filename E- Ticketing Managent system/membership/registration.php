<?php
require "connection.php";

if (isset($_POST['login'])) {
	//redirect to login
	header("location:login.php");exit();
}

if (isset($_POST['signup'])) 
{
	//collect the data
	$username=is_username($_POST['username']);
	$email=is_email($_POST['email']);
	$phone=uncrack($_POST['phone']);
	$passwd=uncrack($_POST['password']);

	$sql="INSERT INTO `users`(`Name`, `Email`, `PhoneNo`, `Password`) 
					VALUES 	('$username','$email','$phone','$passwd')
	";

	if (mysqli_query($conn,$sql)) 
	{
		// success
		header("location:login.php?admitted=true"); exit();		
	}
}


?>


<HEAD>
<TITLE>Registration</TITLE>
<link href="assets/css/style.css" type="text/css"
	rel="stylesheet" />
<link href="assets/css/user-registration.css" type="text/css"
	rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>
<style>
		body{
        background-image:url("/photos/");
        background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; /* Resize the background image to cover the entire container */
    }
.sign-up-container{
  background-image: linear-gradient(to right, #997950,#7f461b);
}
.form-label{
color:white !important;
}
#signup-btn{
	color:white;
	font-weight:bold;
	background: #343a40;
}
</style>
<BODY>
	<section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="photos//final-logo.png"  alt="" class="img-responsive">
                </a>
            </div>
	<div class="phppot-container">
		<div class="sign-up-container">
			<div class="login-signup">
				
			</div>
			<div class="">
				<form name="sign-up" action="registration.php" method="post"
					onsubmit="return signupValidation()">
					<div class="signup-heading" style="color:white">Registration</div>
				<div class="error-msg" id="error-msg"></div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Username<span class="required error" id="username-info"></span>
							</div>
							<input required class="input-box-330" type="text" name="username"
								id="username">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Email<span class="required error" id="email-info"></span>
							</div>
							<input required class="input-box-330" type="email" name="email" id="email">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Phone No<span class="required error" id="signup-password-info"></span>
							</div>
							<input required class="input-box-330" type="phone-no" name="phone" id="Phone-no">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Password<span class="required error"
									id="password-info"></span>
							</div>
							<input required class="input-box-330" type="password"
								name="password" id="password">
						</div>
					</div>
					<div class="row">
						<input class="btn" type="submit" name="signup"
							id="signup-btn" value="Sign up"><br>
								Or <br>
						
						<a href="login.php">
							<span class="btn btn-primary"> Login </span>
						</a> 
						<br>
					</div>
				</form>
			</div>
		</div>
	</div>
	</body>
	</html>