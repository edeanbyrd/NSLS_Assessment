<?php
require_once PROJECT_ROOT_PATH . "/model/database.php";
 
class TokenModel extends Database
{
    public function getToken($token)
    {
		return $this->select("SELECT id FROM tokens where token = ?", ["s", $token]);
    }
	
    public function updateToken($id)
    {
		// increment usage count and set last used on date
		return $this->update("update tokens set usagecount = usagecount + 1, lastusedon = '".date('Y-m-d h:i:s', time())."' where id = ?", ["i", $id]);
    }
}


?>