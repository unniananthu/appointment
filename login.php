<?php 
require 'session.php';

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: patient-dashboard.php");
    exit;
} 
require 'includes/header.php';
// Check if the user is already logged in, if yes then redirect him to welcome page

?>

	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<?php require 'includes/navbar.php'; ?>
			<!-- /Header -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
							
							<!-- Login Tab Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Login">	
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<h3>Login</h3>
										</div>
										<form id="loginForm" method="post" action="userLogin.php" onsubmit="return do_login();">
											<div class="response-message"></div>
											<div class="username-section">
												<div class="form-group form-focus">
													<input type="email" class="form-control floating" name="username" id="userName"required>
													<label class="focus-label">Email</label>
												</div>
												<a class="btn btn-primary btn-block btn-lg login-btn" id="usernameSubmit">Continue</a>
											</div>
											<div class="password-section">
												<div class="form-group form-focus">
													<input type="password" class="form-control floating" name="password" id="password" required>
													<label class="focus-label">Password</label>
												</div>
												<div class="text-right">
													<a class="forgot-link" href="forgot-password.php">Forgot Password ?</a>
												</div>
												<button class="btn btn-primary btn-block btn-lg login-btn" id="userLogin" type="submit">
												Login</button>
											</div>
											
											<div class="text-center dont-have">Don’t have an account? <a href="register.php">Register</a></div>
										</form>
									</div>
								</div>
							</div>
							<!-- /Login Tab Content -->
								
						</div>
					</div>

				</div>

			</div>		
			<!--  Pre loader -->
		   <div class="preloader">
			  	<div class="spinner-grow" style="width: 3rem; height: 3rem;top:50%;left:50%;color:#ce374e;position: absolute" role="status">
				  <span class="sr-only">Loading...</span>
				</div>
		   </div>
			<!-- /Page Content -->
   			<?php include_once 'includes/footer.php'; ?>
   			<script type="text/javascript">
   				$(document).ready(function(){
   					$('#usernameSubmit').on('click', function(){
   						$('#loginForm .response-message').removeClass('errormsg');
   						var username = $("#userName").val();
   						if(username != '' && isEmail(username)){
							    var formData = 'checkEmailAlreadyExists?email='+username;
							    $.ajax({
						            type: 'POST',
						            url: 'fn.api.php',
						            data: {
						                appendData: formData
						            },
							        beforeSend: function() {
   										$('#userName').addClass("disabled");
   										disableButton("usernameSubmit", "a")
							        },
						            success: function(data) {
						                if(data != '' || data != undefined){ 
					   							data = JSON.parse(data);							
					   							if (data.successFlag == 1) {
					   								$('.username-section').hide();
					   								$('.password-section').show();

										        }else{
										        	customNotify("loginForm", data.message, "errormsg")
										        	$('#userName').removeClass("disabled");
													enableButton("usernameSubmit", "a", "Continue");
										        }
				   							}

						            }
						        });
   						}else{
   							customNotify("loginForm", 'Enter a valid email', "errormsg")
   						}
   					})
   				})


   				function do_login() {
   					var username = $("#userName").val();
   					var password = $("#password").val();
   					if (username != "" && password != "") {
					$.ajax({						
							type: 'POST',
				            url: 'userLogin.php',
				            data: {
				                username: username,
				                password: password
				            },
					        beforeSend: function() {
					        	disableButton("userLogin", "b");
					        },
				            success: function(data) {
				                var data = JSON.parse(data);
				                if (data.successFlag == 1) {
				                    location.reload();
				                } else {
				                	customNotify("loginForm", data.message, "errormsg")
				                	enableButton("userLogin", "b", "Login")
				                }

				            }

				        });
					}else {
				         customNotify("loginForm", "Enter password", "errormsg")
	                }
	                return false;					          
				}
   			</script>
	</body>
</html>