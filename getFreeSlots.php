<?php
    require 'config.php';
    $token = getAuthToken();
    $data =  trim($_POST['data'], '&');

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => TEST_BASE_URL.'/getFreeSlots',
      CURLOPT_POSTFIELDS => $params,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token
      ),

    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
?>
