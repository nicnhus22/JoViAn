<?php 
	session_start(); 
	if(!$_SESSION['logged']){ 
	    header("Location: login_page.php"); 
	    exit; 
	} 
?>

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

		<h1><?php echo 'Welcome, '.$_SESSION['email']; ?></h1>



	<!-- JavaScript -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/script.js"></script>

	</body>
</html>