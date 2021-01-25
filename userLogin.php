<?php
require 'config.php';
require 'functions.php';

if(isset($_POST['username'])){	
	$username = $_POST['username'];
	$password = $_POST['password'];

  $tokenData = getAuthToken($username, $password);
  $expirationTime = strtotime($tokenData['expirationTime']);
  $token = $tokenData['token'];


  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => BASE_URL.'validateLogin?username='.$username.'&password='.$password,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer '.$token.''
    ),
  ));


$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response);
if(isset($data->successFlag) && $data->successFlag == 1){
		session_start();
		$_SESSION["userRegID"] = $data->registrationId;
		$_SESSION["loggedin"] = true; 
    $_SESSION["token"] = $token; 
    $_SESSION['sessionExpire'] = date('H:i:s', $expirationTime);
}
echo $response;
}
exit();

?>
