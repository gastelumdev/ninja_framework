<?php if (!empty($errors)): ?>
	<div class="errors">
		<p>Your account could not be created, please check the following:</p>
		<ul>
		<?php foreach ($errors as $error): ?>
			<li><?= $error ?></li>
		<?php endforeach; 	?>
		</ul>
	</div>
<?php endif; ?>
<div id="auth">

	<div class="container">
		<div class="row">
			<div class="col-md-7 col-sm-12 mx-auto">
				<div class="card pt-4">
					<div class="card-body">
						<div class="text-center mb-5">
							<img src="assets/images/favicon.svg" height="48" class='mb-4'>
							<h3>Sign Up</h3>
							<p>Please fill the form to register.</p>
						</div>
						<form action="index.php?user/register" method="post">
							<div class="row">
								<div class="col-md-6 col-12">
									<div class="form-group">
										<label for="firstname">First Name</label>
										<input type="text" id="firstname" class="form-control"
											name="firstname" required>
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="form-group">
										<label for="lastname">Last Name</label>
										<input type="text" id="lastname" class="form-control"
											name="lastname" required>
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" id="email" class="form-control"
											name="email" required>
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" id="password" class="form-control"
											name="password" required>
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="form-group">
										<label for="image">Image</label>
										<input type="file" id="image" class="form-control"
											name="image">
									</div>
								</div>
							</diV>

							<a href="index.php?login">Have an account? Login</a>
							<div class="clearfix">
								<button class="btn btn-primary float-end">Submit</button>
							</div>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>

</div>