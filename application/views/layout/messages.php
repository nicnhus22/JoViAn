<div class="messages">
	<?php if (isset($messages['info'])): ?>
		<?php foreach ($messages['info'] as $message): ?>
			<div class="alert alert-success" role="alert"><?php echo $message; ?></div>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if (isset($messages['error'])): ?>
		<?php foreach ($messages['error'] as $message): ?>
			<div class="alert alert-danger" role="alert"><?php echo $message; ?></div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>