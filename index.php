<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>JoViAnNi</title>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

		<!-- The main CSS file -->
		<link href="/~kgc353_4/assets/css/style.css" rel="stylesheet" />
		<link href="/~kgc353_4/assets/css/bootstrap.min.css" rel="stylesheet">

	</head>
	<body>
		<!-- Main Container begins -->
		<div class="container">
	        <div class="card card-container">
	            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
	            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
	            <p id="profile-name" class="profile-name-card"></p>
	            <form method="POST" class="form-signin" accept-charset="UTF-8" action="includes/login.php">
	                <span id="reauth-email" class="reauth-email"></span>
	                <input type="text"     name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
	                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
	                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submit">Sign in</button>
	            </form><!-- /form -->
	            <a href="#" class="forgot-password">
	                Forgot the password?
	            </a>
	        </div><!-- /card-container -->
	    </div><!-- /container -->
		<!-- Main Container Ends -->
		 
	<!-- JavaScript -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/script.js"></script>
	</body>
</html>