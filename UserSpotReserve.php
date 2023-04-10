<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0">
		<title>User Spot Reserve Form</title>
		<link rel="stylesheet" href="SAVESPOT1HTML.css">
	</head>
	<body>
		<div class="container">
			<form action="SUBMIT" class="form" id="SaveSpot">
				<h1 class="form__title">Save a Spot</h1>
				<div class="form__message form__message--error"></div> <!-- need to be conditional -->
				<div class="form__input-group"> <!-- change class names-->
					<input type="text" class="form__input" autofocus placeholder="First Name">
					<div class="form__input-error-message"></div>
				</div>
				<div class="form__input-group"> <!-- change class names-->
					<input type="text" class="form__input" autofocus placeholder="Last Name">
					<div class="form__input-error-message"></div>
				</div>
				<div class="form__input-group"> <!-- change class names-->
					<input type="tel" class="form__input" autofocus placeholder="Phone Number">
					<div class="form__input-error-message"></div>
				</div>
					<button class="form__button" type="SUBMIT">Submit</button>
			</form>
		</div>
	</body>
</html>