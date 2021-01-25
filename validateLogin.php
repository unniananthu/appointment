<?php

session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}else{
      
      $data = $_POST['formData'];
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://192.168.16.34:6065/rest/validateLogin?'.$data,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
          'Cookie: JSESSIONID=385426EADC9642B5CBFDFB0002A877C5'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return  json_decode($response);
    }
}