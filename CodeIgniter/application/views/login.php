<article id="login_container" class="login_container">
	<h1>Login</h1>	
	<form id="login_form" action="<?php echo site_url('auth/login'); ?>" method="POST">
		<input type="text" name="email" placeholder="Email"/>
		<input type="password" name="password" placeholder="Password"/><br/>
		<a href="#">I am dumb, I forgot my password...</a>
		<div class="login_icon">
			<a href="javascript:void(0)" onclick="document.getElementById('login_form').submit();"><i class="fa fa-arrow-circle-o-right"></i></a>
		</div>
	</form>
	<a class="create_account" href="javascript:void(0)" onclick="createAccount()">Create an account</a>
</article>

<article id="create_account_container" class="login_container">
	<h1>Create Account</h1>	
	<form id="signup_form" action="<?php echo site_url('auth/signup'); ?>" method="POST">
		<input type="text" name="first_name" placeholder="First Name" required/><br/>
		<input type="text" name="last_name" placeholder="Last Name" required/><br/>
		<input type="text" name="email" placeholder="Email" required/>
		<input type="password" name="password" placeholder="Password" required/><br/>
		<input type="password" name="password2" placeholder="Re-Enter Password"/ required><br/>
		<div class="login_icon">
			<a href="javascript:void(0)" onclick="document.getElementById('signup_form').submit();"><i class="fa fa-money"></i></a>
		</div>
	</form>
	<a class="create_account" href="/">Go back to login</a>
</article>