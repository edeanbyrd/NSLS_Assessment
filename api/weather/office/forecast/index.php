<?
// This file is used to recieve requests for weather data
// expects 64 Character token, valid email and valid website address as header values
// returns weather forcasting data

require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/controller/api/tokencontroller.php";

$tc = new TokenController();

$myheaders = $tc->getRequestHeaders();

$email = $myheaders["Email"];
$website = $myheaders["Website"];
$tc->validateEmail($email);
$tc->validateWebsite($website);

$token = $tc->grabToken();
$tokenid = $tc->checkToken($token);
$updated = $tc->TokenUsed($tokenid);

$forecast = new ForecastController();
$forecast->getForecast($token,$website, $email);
exit(0);
?>