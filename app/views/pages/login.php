	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-b-160 p-t-50">
				<form action="app/logic/doLogin.php" method="POST" class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						Account Login
					</span>
					<?php if(isset($_SESSION['ErrorLogin'])): ?>
					<span class="login100-form-title p-b-43">
						<?php foreach($_SESSION['ErrorLogin'] as $error):
								echo $error; 	
							endforeach;
						?>
					</span>
					<?php endif; ?>
					
					<div class="wrap-input100 rs1 validate-input" data-validate = "Email is required">
						<input class="input100" type="text" id="email" name="email" required>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
						<input class="input100" type="password" id="password" name="password" required>
						<span class="label-input100">Password</span>
					</div>

					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" id="signIn" name="signIn"/>
					</div>
				</form>
			</div>
		</div>
	</div>

