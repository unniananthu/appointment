<?php
require 'config.php';
require 'functions.php';

if(isset($_POST['email'])){	

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => TEST_BASE_URL.'checkEmailAlreadyExists?email='.$_POST['email'],
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
echo $response;
}
exit();

?>