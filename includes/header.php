<?php
    // include_once 'session.php';
    // require_once 'config.php';

    $url = explode('/',$_SERVER['PHP_SELF']);	//Get current path
    $suburl = explode('#', $url[count($url)-1]);	//Extract current page name from path
    $languages = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
		<title>
			MCS Hospital Appointments - <?php
			if($suburl[0]=='index.php'){ echo ' Home'; } 
            if($suburl[0]=='aboutus.php'){ echo 'ABOUT US'; } 
            if($suburl[0]=='services.php'){ echo 'SERVICES'; } 
            if($suburl[0]=='index2.php'){ echo 'PROJECTS'; } 
            if($suburl[0]=='gallery.php'){ echo 'GALLERY'; } 
            if($suburl[0]=='carrier.php'){ echo 'CARRIER'; } 
            if($suburl[0]=='contactus.php'){ echo 'CONTACT US'; }
            if($suburl[0]=='registration.php'){ echo 'JOB APPLICATION'; }  
            if($suburl[0]=='selectedproject.php'){ echo 'PROJECT DETAIL'; } 
         ?>
         </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="./assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="./assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="./assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="./assets/css/style.css">
		<link rel="stylesheet" href="./assets/css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="./assets/css/intlTelInput.css">


		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
		
</head>

