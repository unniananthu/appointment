<?php
include 'config.php';
error_reporting(E_ALL ^ E_NOTICE);

if(!isset($_SESSION)){	
	session_start();
}
if (isset($_SESSION['userRegID']) && $_SESSION['userRegID'] != null){
		$time = date('H:i:s', $_SERVER['REQUEST_TIME']);
		$userRegID = $_SESSION['userRegID'];
		if(isset($_SESSION['LAST_ACTIVITY'])) {
			$expiryDiff = $_SERVER['REQUEST_TIME'] - strtotime($_SESSION['LAST_ACTIVITY']);
			if($expiryDiff < strtotime($_SESSION['sessionExpire'])){
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => TEST_BASE_URL.'getPatientDetailsByID?id='.$userRegID,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'POST',
				  CURLOPT_HTTPHEADER => array(
				    'Authorization: Bearer '.$_SESSION["token"].''
				  ),
				));
				$response = curl_exec($curl);
				curl_close($curl);
				$userData = json_decode($response);
				$userFirstName = $userData->FirstName;
				$userLastName = $userData->LastName;
				$userEmail = $userData->Email;
				$userGender = $userData->Gender;
				$userMobileNo = $userData->MobileNo;
			}else{
				session_unset();    
        		session_destroy();
			}
		}else{
			$_SESSION['LAST_ACTIVITY'] = $time;
		}
}

?>