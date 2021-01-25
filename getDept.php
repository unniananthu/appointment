<?php
    require 'config.php';
    $token = getAuthToken();

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => TEST_BASE_URL.'/getDept',
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

    $jsonData = json_decode($response);
    $keys = array_keys($jsonData);                        
    for($i = 0; $i < count($jsonData); $i++) {
        echo $jsonData[$keys[$i]]->expirationTime;
     }

}
