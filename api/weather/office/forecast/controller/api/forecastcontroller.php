<?php
class ForecastController extends BaseController
{

	/** 
	 * Get forecast
	 * */
	function getForecast($token,$website, $email){
		
		/* API URL */
		$url = 'https://api.weather.gov/gridpoints/OKX/31,34/forecast';

		/* Init cURL resource */
		$ch = curl_init($url); 
		/* set the content type json */
		$HeaderArray = [];
		$HeaderArray[] = 'Content-Type:application/json';
		$HeaderArray[] = "User-Agent: (".$website.", ".$email.")";

		curl_setopt($ch, CURLOPT_HTTPHEADER, $HeaderArray);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // allow redirects 

		/* set return type json */
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		try{
			/* execute request */
			$result = curl_exec($ch);

			/* close cURL resource */
			curl_close($ch);

			//echo(array('Content-Type: application/json', 'HTTP/1.1 200 OK').$result);
			$this->sendOutput(
                $result,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
			
			
		} catch (Error $e) {
            //Something went wrong!
			$strErrorDesc = 'HTTP 1.1 401 ';
			$strErrorHeader = 'HTTP 1.1 401';
			$this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
	}
}


?>