<?php
//////////////////////////////////////////////////////////////////////
// Example use of the weather.gov api 
    
/* API URL */
$url = '/api/weather/office/forecast';

/* Init cURL resource */
$ch = curl_init($url); 

/* define values - replace with your own */
$token = "Secure_Token";
$website = "Valid_Website_Address";
$email = "Valid_Email_Address";

/* set the content type json */
$HeaderArray = [];
$HeaderArray[] = 'Content-Type:application/json';
$HeaderArray[] = "Authorization: Bearer ".$token;
$HeaderArray[] = "Website: ".$website;
$HeaderArray[] = "Email: ".$email;

curl_setopt($ch, CURLOPT_HTTPHEADER, $HeaderArray);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // allow redirects 

/* set return type json */
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

/* execute request */
$result = curl_exec($ch);

/* close cURL resource */
curl_close($ch);

?>
