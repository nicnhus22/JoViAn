<!--  -->
<article class="profile_container">
	<h1>Profile</h1>
	<form id="login_form" action="<?php echo site_url('auth/login'); ?>" method="POST">
		<input type="text" name="username" placeholder="Username"/>
		<input type="password" name="password" placeholder="Password"/><br/>
		<a href="#">I am dumb, I forgot my password...</a>
		<div class="login_icon">
			<a href="javascript:void(0)" onclick="document.getElementById('login_form').submit();"><i class="fa fa-arrow-circle-o-right"></i></a>
		</div>
	</form>
</article>