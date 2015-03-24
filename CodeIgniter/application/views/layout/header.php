<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php print $title; ?></title>

	<link rel="stylesheet" type="text/css" href="/public/bootstrap-3.3.2-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/public/css/style.css">
	
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

	<!-- Responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>
	<div class="main_container">

		<!-- Header -->
		<header>
			<div class="icon_block">
				<i class="fa fa-laptop"></i>
				<span class="mobile_resp_disapear">
					<span class="text_white">C<span class="resp_disapear">omputer</span></span><span class="text_orange">S<span class="resp_disapear text_orange">ales</span></span>
				</span>
			</div>


			<?php 
				if(!empty($_SESSION["active_user"])){
					echo '<div class="logout" ><a href="' . site_url('auth/logout') . '"><i class="fa fa-sign-out"></i> Logout</a></div>';
				}
			?>
		</header>
		
		<section>			