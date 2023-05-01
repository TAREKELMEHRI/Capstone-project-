<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0">
	<title>Partner Login</title>
	<link rel="stylesheet" href="SAVESPOT1HTML.css">
	<script src="SaveSpot1.js"></script>
</head>
<body>
<div class="container">
	<form action="SaveSpotHTML1.php" method= "post" class="form" id="login">
		<h1 class="form__title">SaveSpot Partner Login</h1>
		<div class="form__message form__message--error"></div> 
		<div class="form__input-group"> 
			<input type="text" name = "un" class="form__input" autofocus placeholder="Username or email">
			<div class="form__input-error-message"></div>
		</div>
		<div class="form__input-group"> 
			<input type="password" name = "pw" class="form__input" autofocus placeholder="Password">
			<div class="form__input-error-message"></div>
		</div>
	
		<button class="form__button" name="signinSubmit" type="SUBMIT">Submit</button>

		<p class="form__text">
			<a href="#" class="form__link">Forgot your password?</a>
		</p>
		<p class="form__text">
			<a id="linkCreateAccount" href="./" class="form__link">Not a Partner With SaveSpot? Click Here</a>
		</p>
	</form>
		
	<form class="form form--hidden" action="SaveSpotHTML1.php" method= "post" id="createAccount">
		<h1 class="form__title">Create Partner Account</h1>
		<div class="form__message form__message--error"></div> 
		<div class="form__input-group"> 
			<input type="text" name="username" class="form__input" autofocus placeholder="Username">
			<div class="form__input-error-message"></div>
		</div>
		<div class="form__input-group"> 
			<input type="text" name="email" class="form__input" autofocus placeholder="Email Address">
			<div class="form__input-error-message"></div>
		</div>
	<div class="form__input-group"> 
			<input type="password" name="password" class="form__input" autofocus placeholder="Password">
			<div class="form__input-error-message"></div>
		</div>
	<div class="form__input-group"> 
			<input type="password" name="cpassword" class="form__input" autofocus placeholder="Confirm Password">
			<div class="form__input-error-message"></div>
		</div> 
		<button class="form__button" name="createAccountSubmit" type="SUBMIT">Submit</button> 
		<p class="form__text">
			<a id="linkLogin" href="./" class="form__link">Already have an Account? Click Here</a>
		</p>

	</form> 

	<?php
	$servername = "72.167.58.111";
	$username = "admin1";
	$password = "admin";
	$dbname = "savespotnow_db";
	if(isset($_POST["createAccountSubmit"])){

		$un = $_POST["username"];
		$email = $_POST["email"];
		$pw = $_POST["password"];
		$cpw = $_POST["cpassword"];


        $conn = mysqli_connect($servername, $username, $password);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        mysqli_select_db ($conn , $dbname);


		if($cpw == $pw){
			header("Location: http://savespotnow.com/FinalPartnerDashboard.php");
			$query = "INSERT INTO `Partner_users`(`username`, `email`, `password`) VALUES ('$un', '$email', '$pw');";
			mysqli_query($conn, $query);
			mysqli_close($conn);

			exit;
		}
		else{
			mysqli_close($conn);
		}
		
	}
	
	if(isset($_POST["signinSubmit"])){
		$user = $_POST["un"];
		$pass = $_POST["pw"];

        $conn = mysqli_connect($servername, $username, $password);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        mysqli_select_db ($conn , $dbname);

		$sql = "SELECT * FROM `Partner_users` WHERE (username = '$user' AND password = '$pass') or (email = '$user' AND password = '$pass')";
		$result = mysqli_query($conn, $sql);

		$numrows = mysqli_num_rows($result);
		
		if($numrows > 0){
			header("Location: http://savespotnow.com/FinalPartnerDashboard.php");
			mysqli_close($conn);
			exit;
		}
		else{
			echo 'Username or Password is incorrect';
			mysqli_close($conn);
		}
		
	}
	
	?>
</div>
</body>
</html>