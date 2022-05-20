<?php
class BaseController
{
    /**
     * __call magic method.
     */
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }
 

	
	/** 
	 * Get header Authorization
	 * */
	function getAuthHeader(){
		$headers = null;
		if (isset($_SERVER['Authorization'])) {
			$headers = trim($_SERVER["Authorization"]);
		}
		else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
			$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
		} elseif (function_exists('apache_request_headers')) {
			$requestHeaders = apache_request_headers();
			//print_r($requestHeaders);
			if (isset($requestHeaders['Authorization'])) {
				$headers = trim($requestHeaders['Authorization']);
			}
		}
		return $headers;
	}

	/**
	 * get access token from header
	 * */
	function grabToken() {
		$headers = $this->getAuthHeader();
		// HEADER: Get the access token from the header
		if (!empty($headers)) {
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				return $matches[1];
			}
		}
		// otherwise send error
		$strErrorDesc = 'HTTP 1.1 401 Unauthorized';
        $strErrorHeader = 'HTTP 1.1 401';
		$this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
        	array('Content-Type: application/json', $strErrorHeader)
        );
		exit;
	}
	
	/**
	 * used to grab email and website headers
	 * */
	function getRequestHeaders() {
		$headers = array();
		foreach($_SERVER as $key => $value) {
			if (substr($key, 0, 5) <> 'HTTP_') {
				continue;
			}
			$header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
			$headers[$header] = $value;			
		}
		return $headers;
	}
	
	function validateEmail($email){
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// invalid emailaddress
			$strErrorDesc = 'HTTP 1.1 400 Bad Email '.$email;
			$strErrorHeader = 'HTTP 1.1 400';
			$this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
				array('Content-Type: application/json', $strErrorHeader)
			);
			exit;
		}	
	}
	
	function validateWebsite($website){				
		if (!file_get_contents($website)) {
			// invalid emailaddress
			$strErrorDesc = 'HTTP 1.1 400 Bad website '.$website;
			$strErrorHeader = 'HTTP 1.1 400';
			$this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
				array('Content-Type: application/json', $strErrorHeader)
			);
			exit;
		}	
	}
	
	 /**
     * Send API output.
     *
     * @param mixed  $data
     * @param string $httpHeader
     */
    protected function sendOutput($data, $httpHeaders=array())
    {
        header_remove('Set-Cookie');
 
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
 
        echo $data;
        exit;
    }
}


?>