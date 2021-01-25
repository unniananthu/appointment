<?php
function getDepartmentList(){
	$curl = curl_init();
	$authorization = "Authorization: Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJLdW1hcmNoYXJhbmppdDg4Z21haWwuY29tIiwiZXhwIjoxNjA4NTU0NDAyLCJpYXQiOjE2MDg1MzY0MDJ9.sphYIsgNrlCAwZNAetQsIS4tiyZAUvuQH4ScedJ0KPyme9PrVTvpduBl7UHzb7-4uTwC0eqQ7Wb-jrm6Joaguw";
	
	curl_setopt($curl, CURLOPT_URL, 'http://192.168.16.34:7071/PatientAppService-0.0.1/getDept');
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,  array('Content-Type: application/json' , $authorization ));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);


	$response = curl_exec($curl);

	curl_close($curl);
	echo $response;

}
function validateLogin($username, $password){

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'validateLogin?username='.$username.'&password='.$password.'',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	));

	$response = curl_exec($curl);
	curl_close($curl);

	return json_decode($response);

}

function getAuthToken($username, $password){

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://61.2.64.166:3333/PatientAppService-0.0.1/authenticate',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
			"username": "'.$username.'",
			"password": "'.$password.'"
			}',
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);
	curl_close($curl);
	
    $jsonData = json_decode($response, true);
   //  $curl_header = "CURLOPT_HTTPHEADER => array(
   //  'Authorization: Bearer ".."
	  // ),'";


    // return $jsonData['token'];
    return $jsonData;

}

function getUserDetails($userRegID){
	if($userRegID != null){
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
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$jsonData = json_decode($response);
		echo $response;
	}	
}

