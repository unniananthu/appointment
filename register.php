<?php
 require 'session.php';
 if(isset($_SESSION["loggedin"])){
    header("location: patient-dashboard.php");
    exit;
}

 include_once 'includes/header.php'; ?>

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
						<div class="col-md-8 offset-md-2 form-tabs">
								
							<!-- Register Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Register">	
									</div>
									<div class="col-md-12 col-lg-6 login-right tab active" data-attr="registration">
										<div class="login-header">
											<h3>Create New Account</h3>
										</div>
										
										<!-- Register Form -->
										<form id="registerUser">
											<div class="response-message"></div>
											<div class="form-group form-row ">
												<div class="col form-focus">
													<input type="text" class="form-control floating" data-mand="true" id="firstName" name="firstName">
													<label class="focus-label" for="firstName">First Name <span class="text-danger">*</span></label>
												</div>
												<div class="col form-focus">
													<input type="text" class="form-control floating" data-mand="true" id="lastName" name="lastName">
													<label class="focus-label"  for="lastName">Last Name <span class="text-danger">*</span></label>
												</div>												
											</div>
											<div class="form-group form-focus">
												<input type="mail" class="form-control floating" data-mand="true" name="email">
												<label class="focus-label">Email <span class="text-danger">*</span></label>
											</div>
											<div class="form-group">
												<input name="mobileNo" class="form-control" data-mand="true" type="hidden"  rel="phone">
												<input id="phone" onkeypress="return isNumber(event);" maxlength="10" class="form-control phone" type="tel" >
											</div>
											<!-- <div class="form-group form-focus">
												<input type="text" class="form-control floating">
												<label class="focus-label">Mobile Number</label>
											</div> -->
											<div class="form-gender" style="display: flex;">
												Gender&nbsp;<span class="text-danger">*</span>												
													<label class="payment-radio credit-card-option ml-3" style="width: 30%">
														<input type="radio" name="gender" data-mand="true" value="MALE" required="">
														<span class="checkmark"></span>
														Male
													</label>
													<label class="payment-radio credit-card-option"  style="width: 30%">
														<input type="radio" name="gender" data-mand="true"  value="FEMALE" required>
														<span class="checkmark"></span>
														Female
													</label>
											</div>
											<br>
											<div class="form-group  form-focus">
													<div class="cal-icon">
														<input data-mand="true" type="text" name="dateOfBirth" id="dateOfBirth" class="form-control floating datetimepicker" onkeydown="return false" required>
														<label class="focus-label">DOB  <span class="text-danger">*</span></label>
													</div>	

												</div>
											<div class="text-right">
												<a class="forgot-link" href="login.php">Already have an account?</a>
											</div>
											<a class="btn btn-primary btn-block btn-lg login-btn" id="signUpBtn">Signup</a>
										</form>
										<!-- /Register Form -->
										
									</div>
									<!-- OTP Content -->
							
									<div class="col-md-12 col-lg-6 login-right tab"  data-attr="otp">
										<div class="login-header">
											<h3>Verify OTP</h3>
										</div>
										<form  id="otpForm">
											<div class="response-message"></div>
											<div class="form-group form-focus">
												<input type="text" class="form-control floating" id="otpVal">
												<label class="focus-label">Enter OTP <span class="text-danger">*</span></label>
											</div>
											<div class="text-right">
													<span class="forgot-link resendotp-btn">Resend OTP</span>
												</div>
											<a class="btn btn-primary btn-block btn-lg login-btn" id="otpSubmit">Verify</a>
										</form>
									</div>
									
									<!-- Password Content -->
									
									<div class="col-md-12 col-lg-6 login-right tab"  data-attr="password" >
										<div class="login-header">
											<h3>Complete Registration</h3>
										</div>
										<form id="setPasswordForm">
											<div class="response-message"></div>
											<div class="form-group form-focus">
												<input type="password" class="form-control floating" id="password1">
												<label class="focus-label">Setup A Password <span class="text-danger">*</span></label>
											</div>
											<div class="form-group form-focus">
												<input type="password" class="form-control floating" id="password2">
												<label class="focus-label">Confirm Password <span class="text-danger">*</span></label>
											</div>
											<a class="btn btn-primary btn-block btn-lg login-btn" id="passwordSubmit">Register</a>
										</form>
									</div>
								</div>
							</div>

							
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->

			<!-- Alerts Modal -->
			<div class="modal fade custom-modal">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="success-cont">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- / Alerts Modal -->

			<!--  Pre loader -->
		   <div class="preloader">
			  	<div class="spinner-grow" style="width: 3rem; height: 3rem;top:50%;left:50%;color:#ce374e;position: absolute" role="status">
				  <span class="sr-only">Loading...</span>
				</div>
		   </div>
   			<?php include_once 'includes/footer.php'; ?>

	   		<!-- Datetimepicker JS -->
			<script src="assets/js/moment.min.js"></script>
			<script src="assets/js/bootstrap-datetimepicker.min.js"></script>


			<!-- Custom JS -->
			<script src="assets/js/script.js"></script>
			<script type="text/javascript" src="assets/js/main.js"></script>
   			<script>
			$(document).ready(function() {
				    $('#signUpBtn').on('click', function() {
				        saveOnlineAppointmentRegistration();
				    })
				    
				    

				    if($('#dateOfBirth').length > 0) {
						$('#dateOfBirth').datetimepicker({
							format: 'DD-MM-YYYY',
							icons: {
								up: "fas fa-chevron-up",
								down: "fas fa-chevron-down",
								next: 'fas fa-chevron-right',
								previous: 'fas fa-chevron-left'
							}
						});
					}



			});	

			function saveOnlineAppointmentRegistration(data) {
				    // var full_number = $('.iti__selected-dial-code').text();
				    // if(($("input[name ='mobileNo']").val() == '') && ($("#phone").val() != '')){
				    // 	$("input[name ='mobileNo']").val(full_number + $('#phone').val());
				    // }
				    
				    if (data == undefined) {
				        if (validateForm("registerUser") && $("input[name='gender']").is(':checked')) {
				        	if(isEmail($("input[name='email']").val())){
				            var formDataArray = $('#registerUser').serializeArray();
				            var o = {};
				            $.each(formDataArray, function() {
				                if (o[this.name]) {
				                    if (!o[this.name].push) {
				                        o[this.name] = [o[this.name]];
				                    }
				                    o[this.name].push(this.value || '');
				                } else {
				                    o[this.name] = this.value || '';
				                }
				            });
				            var formDataJson = JSON.stringify(o);

				            var formData = "saveOnlineAppointmentRegistration?appDetails=" + encodeURI(formDataJson);
				            ajaxPost(formData, saveOnlineAppointmentRegistration);
				        }else{
				        	$("input[name='email']").addClass('invalid')
				        	customNotify('registerUser','Enter a valid email',  'errormsg')
				        }
				        }else{
				        	customNotify('registerUser','Enter all required fields', 'errormsg' )
				        }
				    } else {
				        var data = JSON.parse(data);
				        if(data.successFlag != undefined && data.successFlag == 1){	
				        	var regId = data.registrationId;
				       		console.log(data)			        	
				        	showTab("otp");	
				        	customNotify('otpForm',data.message, 'successmsg' );
				        	$('.resendotp-btn').on('click', function(){
				        		var formData = 'resendOTPAgainstRegId?registrationId='+regId;
				        		 $.ajax({
			        		            type: 'POST',
			        		            url: 'fn.api.php',
			        		            data: {
			        		                appendData: formData
			        		            },
			        			        beforeSend: function() {
			        			        	 $('.preloader').show()
			        			        },
			        		            success: function(data) {
			        		            	 $('.preloader').hide()
			        		            	 var data = JSON.parse(data);
			        		            	  if (data != undefined) {
			        			            	 if(data.successFlag != undefined && data.successFlag == 1){
			        			            	 	customNotify("otpForm",  data.message,  'successmsg')
			        			            	 }else{
							           				customNotify('otpForm', data.message, 'errormsg')
			        					        }
			        					    }else{
			        					    	customNotify('otpForm', "Something went wrong!", 'errormsg')
			        					    }
			        		            }
			        		        })
				        	})
				        	$('#otpSubmit').on('click', function() {
					    	var otpVal = $('#otpVal').val();
					    	if(otpVal != ""){
					    		var formData = 'validateOTPAgainstRegId?registrationId=' + data.registrationId + '&oTP='+ otpVal;
					    		 $.ajax({
						            type: 'POST',
						            url: 'fn.api.php',
						            data: {
						                appendData: formData
						            },
							        beforeSend: function() {
							        	$('#otpSubmit').prop("disabled", true);
									    $('#otpSubmit').html(
									        `<span class="spinner-border spinner-border-sm mr-3 mb-1" role="status" aria-hidden="true"></span>Loading...`
									    );

							        },
						            success: function(data) {
							           var otpdata = JSON.parse(data);
							           if(otpdata.successFlag != undefined && otpdata.successFlag == 1){
							           		showTab("password");
											$('#passwordSubmit').on('click', function() {
										    	var password1 = $('#password1').val();
										    	var password2 = $('#password2').val();
										    	if(password1 != "" && password2 != "" ){
										    		if(password1 == password2){
										   var formData = 'savePwdForRegId?registrationId=' + regId + '&password='+ password1;
										    				$.ajax({
													            type: 'POST',
													            url: 'fn.api.php',
													            data: {
													                appendData: formData
													            },
														        beforeSend: function() {
														        	$('#passwordSubmit').prop("disabled", true);
																    $('#passwordSubmit').html(
																        `<span class="spinner-border spinner-border-sm mr-3 mb-1" role="status" aria-hidden="true"></span>Loading...`
																    );

														        },
													            success: function(data) {
														           var passdata = JSON.parse(data);
														           if(data != undefined){     	
															           if(passdata.successFlag != undefined && passdata.successFlag == 1){
																           	alert(passdata.message);
																           	window.location = "login.php";

															           }else{
															           	customNotify("setPasswordForm",  passdata.message,  'errormsg')
															           }
														           }
														            $('#passwordSubmit').prop("disabled", false);
									   								$('#passwordSubmit').html("Register");
							       								}
							      							 })

										    		}else{
										    		customNotify("setPasswordForm", "Password missmatch!",  'errormsg')				    			
										    		}
										    	}else{
										    		customNotify("setPasswordForm", "Please fill all the fields",  'errormsg')
										    	}
										    })


							           }else{
							           		customNotify('otpForm', otpdata.message, 'errormsg')
							           }
							           $('#otpSubmit').prop("disabled", false);
									    $('#otpSubmit').html("Verify");
						            }
						        })
					        	
					    	}else{
					    		customNotify("otpForm", "Please enter the OTP", 'errormsg')
					    	}
					    })
				        }else{
				        	customNotify('registerUser', data.message, 'errormsg');
				        }
				      }
				}

				function validateOTP(data){

					 if (data == undefined) {
					        var userID = "<?php echo $_SESSION['userRegID']; ?>";
						        if (userID != '' || userID != undefined) {
						            var formData = 'validateOTPAgainstRegId?registrationId=' + userID+ '&oTP='+ $("input[name='oTP']").val();
						            ajaxPost(formData, validateOTP);
						        }
					    } else {
					        var data = JSON.parse(data);
						       if(data.successFlag != undefined && data.successFlag == 1){
					        		showTab("password");				        	
						        }else{
						        	customNotify("otpForm", data.message, 'errormsg')
						        }
					}
				}

				// function passwordSave(data){

				// 	 if (data == undefined) {
				// 	        var userID = "<?php echo $_SESSION['userRegID']; ?>";
				// 		        if (userID != '' || userID != undefined) {
				// 		            var formData = 'savePwdForRegId?id=' + userID+ '&oTP='+ $("input[name='oTP']").val();
				// 		            ajaxPost(formData, passwordSave);
				// 		        }
				// 	    } else {
				// 	        var data = JSON.parse(data);
				// 	        if(data != undefined){					        	
				// 		       if(data.successFlag != undefined && data.successFlag == 1){
				// 	        		alert('Success');			        	
				// 	        		window.location = "login.php";	
				// 		        }else{
				// 	        	customNotify("setPasswordForm", data.message , 'errormsg')					        	
				// 		        }
				// 	        }else{
				// 	        	customNotify("setPasswordForm", "Something went wrong", 'errormsg')
				// 	        }
				// 		}
				// 	}

		</script>
		<script>
		    var input = document.querySelector(".phone");
		    window.intlTelInput(input, {
		      separateDialCode: true,
		      utilsScript: "./assets/js/utils.js",
		    });
		  </script>
		
	</body>
</html>