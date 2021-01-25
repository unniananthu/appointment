<?php 
require 'session.php';

$isLogged = false;
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	$isLogged = true;
}

?>
<header class="header">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
						<a href="index.php" class="navbar-brand logo">
							<img src="assets/img/mcs-logo-hi.png" class="img-fluid" alt="Logo">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="index.php" class="menu-logo">
								<img src="assets/img/logo.png" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
							</a>
						</div><ul class="main-nav">
							<li>
								<a href="index.php" >Home</a>
							</li>
							<?php if($isLogged){
									echo '<li>
											<a href="patient-dashboard.php">Dashboard</a>
										</li>';
							}?>
								
						</ul>	 
						
					</div>		 
					<ul class="nav header-navbar-rht">
						<li class="nav-item">
							<?php 
								if($isLogged){
									echo '<a class="nav-link header-login" href="logout.php">logout</a>';
								}else{
									echo '<a class="nav-link header-login" href="login.php">login / Signup </a>';
								}
							?>
						</li>
					</ul>
				</nav>
			</header>