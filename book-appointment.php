<?php
 require 'session.php';
 if(!isset($_SESSION["loggedin"])){
    header("location: login.php");
    exit;
}
 include_once 'includes/header.php'; 
 ?>

	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<?php include_once 'includes/navbar.php'; ?>

			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/">Home</a></li>
									<li class="breadcrumb-item"><a href="patient-dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Appointments</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Book Appointment</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container">

					<div class="row">
						<div class="col-md-12 col-lg-12 col-xl-12">
							<button class="btn btn-primary btn-lg login-btn mb-4" onclick="location.href='patient-dashboard.php'"><i class="fas fa-history mr-1"></i> Previous Appointments</button>
							<div class="card">
								<div class="card-body">
								
									<!-- Checkout Form -->
									<form id="bookAppointment" class="book-appointment">
									<div class="info-widget">	
										<h4 class="card-title mb-4">Appointment Details</h4>
										<div class="response-message"></div>
										<input type="hidden" name="registrationId" value="<?php echo $_SESSION['userRegID']; ?>">
										<input type="hidden" name="src" value="1">
										<div class="row form-row">										
											<div class="col-md-6">
												<div class="form-group">
													<label>Select Specialty <span class="text-danger">*</span></label>
													<select class="form-control custom-select" name="deptID" id="deptID" required>
														<option>Select Department</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Select Doctor<span class="text-danger">*</span></label>
													<select class="form-control custom-select" name="doctID" id="doctorID" required disabled="">
														<option>Select Doctor</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Select Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input data-mand="true" type="text" name="appDate" id="appointmentDate" class="form-control datetimepicker" placeholder="Select Date" onkeydown="return false">
													</div>	

												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Select Time <span class="text-danger">*</span></label>
													<input data-mand="true" type="hidden" name="slotID" id="slotID"/>
													<select class="form-control custom-select" name="slotNo" id="freeSlotID" required disabled="">
														<option>Select Time</option>
													</select>
												</div>
											</div>
											<div class="form-bookuser col-6" style="display: flex;">
												Booking For&nbsp;<span class="text-danger">*</span>: 												
													<label class="payment-radio credit-card-option ml-3" style="width: 30%">
														<input type="radio" name="isExist" class="booking-user" value="1" required="">
														<span class="checkmark"></span>
														Yourself
													</label>
													<label class="payment-radio credit-card-option"  style="width: 30%">
														<input type="radio" name="isExist" class="booking-user" value="0" required="">
														<span class="checkmark"></span>
														Someone Else
													</label>
											</div>
										</div>
									</div>
									<div class="bookForFriend">
										<h4 class="card-title mb-4">Patient Details</h4>	
										<div class="row form-row">	
											<div class="col-md-6">
												<div class="form-group">
													<label>First Name <span class="text-danger">*</span></label>
													<input data-mand="true" type="text" name="firstName" class="form-control first-name">
												</div>
											</div>
											<div class="col-md-6">	
												<div class="form-group">
													<label>Last Name <span class="text-danger">*</span></label>
													<input data-mand="true" type="text" name="lastName" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Email <span class="text-danger">*</span></label>
													<input data-mand="true" type="email" name="email" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Phone Number <span class="text-danger">*</span></label>
													<input type="hidden" data-mand="true" name="mobileNo" rel="phone">
													<input id="phone" onkeypress="return isNumber(event);" maxlength="10" class="form-control phone" type="tel">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<!-- <div class="col-md-12">
											<div class="mt-4">
												<label class="custom_check">
													<input type="checkbox" name="gender_type">
													<span class="checkmark"></span> Existing User?
												</label>												
											</div>
										</div> -->
										<div class="col-md-6 mt-2 mb-3" id="UHID">
											<label>Enter UHID</label>
												<input type="text" name="emrNo" class="form-control">
										</div>
										<div class="col-md-12">
											<div class="submit-section mt-4">
												<a class="btn btn-primary submit-btn"  id="submitAptBooking">Confirm Booking</a>
											</div>
										</div>										
									</div>
									</form>
									<!-- /Checkout Form -->
									
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			<?php include_once 'includes/footer.php'; ?>

		<!-- Confirm Booking Modal -->
		<div class="modal fade custom-modal" id="confirm-booking">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Booking Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<ul class="info-details">
							<li>
								<div class="row">
									<div class="col-md-6">
										<span class="title">Speciality:</span>
										<span class="text">Dermatology</span>
									</div>
									<div class="col-md-6">
										<span class="title">Doctor:</span>
										<span class="text">Mathew D</span>
									</div>
								</div>
							</li>
							<li>
							<div class="row">
									<div class="col-md-6">								
								<span class="title">Date</span>
								<span class="text">21 Oct 2019 10:00 AM</span>	
								</div>									
							<div class="col-md-6">
								<span class="title">Time Slot</span>
								<span class="text">09:00 AM - 09:20 AM</span>
							</div>
						</div>
							</li>
						</ul>
					</div>
					<div class="modal-footer">
						<a href="javascript:void(0);" class="btn btn-sm bg-info-light" data-dismiss="modal" aria-label="Close">Edit Details</a>
						<a href="javascript:void(0);" class="btn btn-sm bg-success-light">Confirm</a>
					</div>
				</div>
			</div>
		</div>
		<!-- / Confirm Booking  Modal -->

		<!-- Alerts Modal -->
		<div class="modal fade custom-modal alert-modal" id="alertModal">
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

		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		

		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>


		<script>
			$(document).ready(function() {
			    getDepartmentForSelect();
			    $('#deptID').on('change', function() {
			        getDocListForSelect();
			    })
			    $('#doctorID').on('change', function() {
			        getFreeSlotesForAppointment();
				    })
				    $('#appointmentDate').on('blur', function() {
				        getFreeSlotesForAppointment();
				    })
				    $('#freeSlotID').on('change', function() {
				        $("#slotID").val($(this).find(':selected').attr("data-slotid"));
				    })
				    $('#submitAptBooking').on('click', function() {
				        saveOnlineApps();
				    })
				    // if ($('.booking-user').is(':checked')) {
				    //     loadBookingForm();
				    // }
				    $('.booking-user').change(function() {
				        loadBookingForm();
			    });
				    if($('#appointmentDate').length > 0) {
						$('#appointmentDate').datetimepicker({
							format: 'YYYY-MM-DD',
							minDate:new Date(),
							icons: {
								up: "fas fa-chevron-up",
								down: "fas fa-chevron-down",
								next: 'fas fa-chevron-right',
								previous: 'fas fa-chevron-left'
							}
						});
					}
			});	
			function loadBookingForm() {
			    $('.bookForFriend').hide();
			    if ($('.booking-user:checked').val() == 1) {
			        loadExisitingUser();
			        $('#UHID').show()

			    } else {
			    	resetFields("bookForFriend");
			        $('#UHID').hide()
			        $('.bookForFriend').show();
			    }
			}

			function loadExisitingUser(data) {
			    if (data == undefined) {
			        var userID = "<?php echo $_SESSION['userRegID']; ?>";
			        if (userID != '' || userID != undefined) {
			            var formData = 'getPatientDetailsByID?id=' + userID;
			            ajaxPost(formData, loadExisitingUser);
			        }
			    } else {
			        var data = JSON.parse(data);
			        if(data != undefined){			        	
				        $("input[name='firstName']").val(data.FirstName);
				        $("input[name='lastName']").val(data.LastName);
				        $("input[name='email']").val(data.Email);
				        $("input[name='mobileNo']").val(data.MobileNo);
			        }else{
			        	alertModal('Session Expired! Please Login Again', '', 'login.php', 'Login')
			        	$('.alert-modal').on('hidden.bs.modal click', function(){
			        		window.location.href = 'logout.php';
			        	})

			        	// alert("Session Expired! Please Login Again")
			        }
			        // alert($("input[name='mobileNo']").val())
			    }
			}

			function saveOnlineApps(data) {
				    
				    // if(($("input[name ='mobileNo']").val() == '') && ($("#phone").val() != '')){
				    // 	$("input[name ='mobileNo']").val(full_number + $('#phone').val());
				    // }
				     
				    var aptdateObj = $("input[name = 'appointmentDate']");
				     // console.log($('#bookAppointment').serializeArray())
				    // alert($(aptdateObj).val())
				    if (data == undefined) {
				        if(validateForm("bookAppointment")  && $("input[name='isExist']").is(':checked') && isPhone($("input[name='mobileNo']").val())) {
				        	if(isEmail($("input[name='email']").val())){
				        		disableButton("submitAptBooking", "a");
					        	$('#bookAppointment .response-message').removeClass('errormsg');
					            var formDataArray = $('#bookAppointment').serializeArray();
					            var areID = ["deptID", "doctID", "slotID", "slotNo", "registrationId"];
					            var o = {};
					            $.each($('#bookAppointment').serializeArray(), function() {
					            	if (o[this.name]) {
					                    if (!o[this.name].push) {
					                        o[this.name] = [o[this.name]];
					                    }
					                     o[this.name].push(this.value || '');
					                } else {
					                	if([this.name] == 'deptID' || [this.name] == 'doctID' || [this.name] == 'slotID' || [this.name] == 'slotNo' || [this.name] == 'registrationId' || [this.name] == 'src'){
					                    	o[this.name] = Number(this.value) || '';
					                	}else{
					                    	o[this.name] = this.value || '';
					                	}
					                }

								});
					            
					            var formDataJson = JSON.stringify(o);

					            // var formData = "saveOnlineAppointment?aptDetails=" + formDataJson;
					            console.log(formDataJson)
					            var successContent = `<div class="success-cont">
														<i class="fas fa-check"></i>
														<h3>Appointment booked Successfully!</h3>
														<a href="patient-dashboard.php" class="btn btn-primary view-inv-btn mt-5">View Appointments</a>
													</div>`;
								$(".book-appointment")[0].reset();

								alertModal('Appointment Booked!', '', 'patient-dashboard.php', 'View Appointments')
					            // $('#alertModal').modal('show').find('.success-cont').html(successContent);
					            // console.log(encodeURI(formDataJson))
					            // ajaxPost(formData, saveOnlineApps);
				        	}else{
				        		customNotify('bookAppointment', 'Enter valid Email', 'errormsg');
				        	}
				        }else{
				        	// $('#alertModal .modal-body').text('Enter all the required fields');
				        	customNotify('bookAppointment', 'Enter all required fields', 'errormsg');
				        }
				    } else {
				        var data = JSON.parse(data);
				        console.log(data)
				    }
				}
		</script>	
		<script>
		    var input = document.querySelector(".phone");
		    window.intlTelInput(input, {
		      separateDialCode: true,
		      utilsScript: "./assets/js/utils.js",
		    });
		  </script>

</html>