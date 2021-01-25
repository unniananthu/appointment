<?php

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_PORT => "6065",
CURLOPT_URL => "http://192.168.16.34:6065/rest/saveOnlineApps?aptDetails={%22appDate%22:%22Dec%2029,%202020%2012:00:00%20pm%22,%22deptid%22:17,%22doctorid%22:11,%22email%22:%22jinju@safecaretec.com%22,%22emrNo%22:%22%22,%22firstName%22:%22Jinju%22,%22gender%22:%22MALE%22,%22isExist%22:0,%22lastName%22:%22Joseph%22,%22mobileNo%22:%229710559146603%22,%22registrationId%22:1,%22slotID%22:10,%22slotNo%22:6,%22src%22:1}",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "",
CURLOPT_HTTPHEADER => array(
"Postman-Token: ae6ae034-87fd-4d01-95c8-b22a5c6fcca9",
"cache-control: no-cache"
),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
$res=  json_decode($response);
echo $res;
}