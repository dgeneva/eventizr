<h2>Account Login</h2>

<?php 
$attributes = array('class' => 'form-horizontal well', 'id' => 'loginForm');
echo form_open('/account/connect/do_login', $attributes); ?>

<div class="control-group">
	<label class="control-label" for="input01">Adresse email</label>
	<div class="controls">
		<input type="text" class="input-xlarge" name="username"/>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="input01">Mot de passe</label>
	<div class="controls">
		<input type="password" class="input-xlarge" name="password"/>
		<p class="help-inline">Password lost ? click here</p>
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<input type="checkbox" /> Remember me
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<button type="submit" class="btn btn-primary">Login</button>
	</div>
</div>

<?= form_close(); ?>