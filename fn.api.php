<?php
    require 'config.php';
    require 'functions.php';   

    if(isset($_POST['appendData'])){
    	$data =  $_POST['appendData'];

	    $curl = curl_init();
	    curl_setopt_array($curl, array(
	      CURLOPT_URL => REST_BASE_URL.$data,
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
    }else{
    	echo "Something Went Wrong";
    }
?>
