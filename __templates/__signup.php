<?php

?>

<div class="registration-form">
	<form method="post" action="signup.php">
		<div class="form-icon">
			<span><i class="icon icon-user"></i></span>
		</div>
		<div class="form-group">

			<input type="text" name="username" class="form-control item" id="username" placeholder="Username">

		</div>
		<div class="form-group">
			<input type="password" require name="password" class="form-control item" id="password" placeholder="Password">
		</div>
		<div class="form-group">
			<input type="email" require name="email" class="form-control item" id="email" placeholder="Email">
		</div>
		<div class="form-group">
			<input type="number" require name="phone" class="form-control item" id="phone-number" placeholder="07XXXXXXXX" max='9999999999'>
		</div>
		<div class=" form-group">
			<input type="text" require name="job" class="form-control item" id="job" placeholder="Job">
		</div>
		<hr>
		<div class="form-group">
			<button type="submit" id="submit-btn" class="btn btn-block create-account">Create Account</button>
		</div>
		<h6 class="text-center">Already have Account? 
			<a href="login.php">Click here</a>
			</h6>
	</form>

</div>
