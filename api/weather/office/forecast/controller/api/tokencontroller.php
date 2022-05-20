<?php

class TokenController extends BaseController
{
    
	/**
     *  check if token is valid
     */
    public function checkToken($token)
    {
        $strErrorDesc = '';
 
        try {
            $tokenModel = new TokenModel();
            $arrToken = $tokenModel->getToken($token);
			if ($arrToken != null) { 
				return ($arrToken[0]["id"]);				
			} else {
				// token not found
				$strErrorDesc = 'HTTP 1.1 401 ';
				$strErrorHeader = 'HTTP 1.1 401';
				$this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
					array('Content-Type: application/json', $strErrorHeader)
				);
			}
        } catch (Error $e) {
            //Something went wrong!
			$strErrorDesc = 'HTTP 1.1 401 Unauthorized';
			$strErrorHeader = 'HTTP 1.1 401';
			$this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
		return null;
 
    }
	
	
	/**
     *  update token attributes
     */
    public function TokenUsed($id)
    {
        $strErrorDesc = '';
 
        try {
            $tokenModel = new TokenModel();
            $arrToken = $tokenModel->updateToken($id);
			return null;
        } catch (Error $e) {
            //Something went wrong!
			$strErrorDesc = 'HTTP 1.1 401 Unauthorized';
			$strErrorHeader = 'HTTP 1.1 401';
			$this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
		return null;
 
    }	
}

?>