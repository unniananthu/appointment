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
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Dashboard</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						
						<!-- Profile Sidebar -->
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
							<div class="profile-sidebar">
								<div class="widget-profile pro-widget-content">
									<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
											<img src="assets/img/patients/<?php echo 'USER-'.strtoupper($userGender); ?>.jpg" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3><?php echo $userFirstName.' '.$userLastName; ?></h3>
											<div class="patient-details">
												<h5><?php echo $userGender; ?></h5>
												<h5 class="mb-0"><i class="fas fa-envelope mr-2"></i><?php echo $userEmail; ?></h5>
											</div>
										</div>
									</div>
								</div>
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li class="active">
												<a href="#">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
											<!-- <li>
												<a href="profile-settings.php">
													<i class="fas fa-user-cog"></i>
													<span>Profile Settings</span>
												</a>
											</li>
											<li>
												<a href="change-password.php">
													<i class="fas fa-lock"></i>
													<span>Change Password</span>
												</a>
											</li> -->
											<li>
												<a href="logout.php">
													<i class="fas fa-sign-out-alt"></i>
													<span>Logout</span>
												</a>
											</li>
										</ul>
									</nav>
								</div>

							</div>
						</div>
						<!-- / Profile Sidebar -->
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<a class="btn btn-primary btn-lg login-btn mb-4"  href="book-appointment.php"> <i class="fas fa-calendar-alt mr-1"></i> Book An Appointment </a>
							<div class="card">
								<div class="card-body pt-0 pb-3" style="padding: 0;">
								
									<!-- Tab Menu -->
									<nav class="user-tabs mb-4">
										<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
											<li class="nav-item text-left">
												<a class="nav-link active" href="#pat_appointments" data-toggle="tab">Previous Appointments</a>
											</li>	
										</ul>
									</nav>
									<!-- /Tab Menu -->
									
									<!-- Tab Content -->
									<div class="tab-content pt-0">
										
										<!-- Appointment Tab -->
										<div id="pat_appointments" class="tab-pane fade show active">
											
													<div class="">
														<table class="table table-hover table-center mb-0" id="prevApts">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>Doctor</th>
																	<th>Booking Date</th>
																	<th>Time</th>
																	<th>Mobile No</th>
																	<th>EMR No</th>
																</tr>
															</thead>
														</table>
													</div>
										</div>
										<!-- /Appointment Tab -->
										
										
									</div>
									<!-- Tab Content -->
									
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
			<!--  Pre loader -->
		   <div class="preloader">
			  	<div class="spinner-grow" style="width: 3rem; height: 3rem;top:50%;left:50%;color:#ce374e;position: absolute" role="status">
				  <span class="sr-only">Loading...</span>
				</div>
		   </div>
   
			<?php include_once 'includes/footer.php'; ?>

			<script>
			$(document).ready(function() {
			    getPrevAppointments();			    
			});	

			function getPrevAppointments(data) {
				 if (data == undefined) {
			        var userID = "<?php echo $_SESSION['userRegID']; ?>";
			        // alert(userID)
			        if (userID != '' || userID != undefined) {
			            var formData = 'getPrevAppointmentsByRegID?registrationId=' + userID;
			            ajaxPost(formData, getPrevAppointments);
			        }
			    } else {
			    	var data = JSON.parse(data);
			    	// alert(data)
			    	console.log(data)
			    	if(data.length != 0){
					    $('#prevApts').DataTable({
				            data: data,  // Get the data object
				            order: [[2, 'desc']],
				            columns: [
				                { data : 'FirstName',
				                	 render : function(data, type, row) {
				                	 		return data + " " + row.LastName;
				                	 },
				            	},
				                { data : 'ClinicianName',
							          render : function(data, type, row) {
							              return '<a href="#">'+(data != null ? data : "")+
							              			'<span style="color: #888; 	display: block; 	font-size: 12px; 	margin-top: 3px;">'+ (row.Name != null ? row.Name : "") +'</span>'
							          }    
							       },
				                { data : 'AppDate' },
				                { data : 'AppTime' },
				                { data : 'MobileNo' },
				                { data : 'EmrNo' },
				            ]
				        }); 

			    	}else{
			    		$('#pat_appointments').hide();
			    	}
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