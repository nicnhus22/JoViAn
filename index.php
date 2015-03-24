<?php

require_once 'includes/main.php';

/*--------------------------------------------------
	Handle logging out of the system. The logout
	link in protected.php leads here.
---------------------------------------------------*/


if(isset($_GET['logout'])){

	$user = new User();

	if($user->loggedIn()){
		$user->logout();
	}

	redirect('index.php');
}


/*--------------------------------------------------
	Don't show the login page to already 
	logged-in users.
---------------------------------------------------*/

$user = new User();

if($user->loggedIn()){
	redirect('protected.php');
}


/*--------------------------------------------------
	Handle submitting the login form via AJAX
---------------------------------------------------*/
try{

	if(!empty($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH'])){

		// Output a JSON header

		header('Content-type: application/json');

		// Record this login attempt
		rate_limit_tick($_SERVER['REMOTE_ADDR'], $_POST['email']);

		// Send the message to the user

		$message = '';
		$email = $_POST['email'];
		$subject = 'Your Login Link';
		
		if(!User::exists($email)){
			$subject = "Thank You For Registering!";
			$message = "Thank you for registering at our site!\n\n";
		}

		// Attempt to login or register the person
		$user = User::loginOrRegister($_POST['email']);


		$message.= "You can login from this URL:\n";
		$message.= get_page_url()."?tkn=".$user->generateToken()."\n\n";

		$message.= "The link is going expire automatically after 10 minutes.";

		$result = send_email($fromEmail, $_POST['email'], $subject, $message);

		if(!$result){
			throw new Exception("There was an error sending your email. Please try again.");
		}

		die(json_encode(array(
			'message' => 'Thank you! We\'ve sent a link to your inbox. Check your spam folder as well.'
		)));
	}
}
catch(Exception $e){

	die(json_encode(array(
		'error'=>1,
		'message' => $e->getMessage()
	)));
}

/*--------------------------------------------------
	Output the login form
---------------------------------------------------*/

?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8"/>
		<title>Tutorial: Super Simple Registration System With PHP &amp; MySQL</title>

		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

		<!-- The main CSS file -->
		<link href="assets/css/style.css" rel="stylesheet" />
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	</head>

	<body>
		<!-- Navigation Bar -->
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
		    <div class="container">
		        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		 
		            </a>
		 
		    <a href="#" class="brand">JoViAnNi Computer Store</a>
		 
		    <div class="nav-collapse collapse pull-right">
		        <ul class="nav">
		            <li><a href="#forgot" data-toggle="modal"><i class="icon-user icon-white"></i> Forgot Password</a></li>
		            <li class="divider-vertical"></li>
		            <li><a href="#contact" data-toggle="modal"><i class="icon-envelope icon-white"></i> Contact Us</a></li>
		            <li class="divider-vertical"></li>
		        </ul>
		    </div>
		 
		    </div>
		  </div>
		</div>
		<!-- Navigation Ends -->
		 
		<!-- Main Container -->
		<section>
		<div class="container login">
		    <div class="row ">
		        <div class="center span4 well">
		            <legend>Please Sign In</legend>
		            <div class="alert alert-error">
		                <a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!
		            </div>
		            <form method="POST" action="" id="login-register" accept-charset="UTF-8" action="index.php">
			            <input type="text" id="email" class="span4" name="email" placeholder="Email" />
			            <input type="password" id="password" class="span4" name="password" placeholder="Password" />
			            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign in</button>
		            </form>
		        </div>
		    </div>
		</div>
		<p class="text-center muted ">&copy; Copyright 2013 - Application Name</p>
		</section>
		<!-- Main Container Ends -->
		 
	<!-- JavaScript -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/script.js"></script>
	</body>
</html>