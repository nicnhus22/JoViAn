<article class="profile_container">
	<img src="/public/images/cs.jpg" width="100px" height="100px">
	<h1><?php echo $user->first_name ?> </h1>
	<ul>
		<li><?php echo $user->email ?> </li>
		<li>You are a <?php echo ($user->gender == 'male' ? 'man' : 'woman') ?> </li>
		<li>You're <?php echo $user->age ?> </li>
	</ul>
</article>