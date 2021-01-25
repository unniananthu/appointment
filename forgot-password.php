<?php include_once 'includes/header.php'; ?>
	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<?php include_once 'includes/navbar.php'; ?>
			<!-- /Header -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
							
							<!-- Account Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="assets/img/login-banner.png" class="img-fluid" alt="Login Banner">	
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<h3>Forgot Password?</h3>
											<p class="small text-muted">Verify your email</p>	
										</div>
										<!-- Forgot Password Form -->
										<form id="forgotPassword">
											<div class="response-message"></div>
											<div class="form-group form-focus">
												<input type="email" id="userName" class="form-control floating">
												<label class="focus-label">Email</label>
											</div>
											<div class="text-right">
												<a class="forgot-link" href="login.php">Remember your password?</a>
											</div>
											<a class="btn btn-primary btn-block btn-lg login-btn" id="emailVerify">Verify</a>
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Reset Password</button>
										</form>
										<!-- /Forgot Password Form -->
										
									</div>
								</div>
							</div>
							<!-- /Account Content -->
							
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			<?php include_once 'includes/footer.php'; ?>

			<script>
				$('#emailVerify').on('click', function(){
					var username = $('#forgotPassword #userName').val();
					if(username != ''){

					}else{
						$('.response-message').addClass('errormsg');
						$('.errormsg').html('Enter a valid email');
					}
				})

			</script>
	</body>

<!-- doccure/forgot-password.html  30 Nov 2019 04:12:20 GMT -->
</html>