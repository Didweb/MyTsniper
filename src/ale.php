<?php

class ale_SN
{
	

	public function ale($length = 5) {
		$characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {	
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
    return $randomString;
	}	
	
}

?>
