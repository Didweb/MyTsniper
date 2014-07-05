<?php

class mapeatxt_SN
{
	

	public function mapeatxt($txt,$numArguments)
	{
		$retorno = '#';
		$numArguments = func_num_args();
		if (isset($txt)) { $retorn = $txt; }
		
		if ($numArguments > 1) {
			
			$llistaArguments = func_get_args(); 
					for ($i=1; $i<$numArguments; $i++) {
						$retorn = preg_replace( "#%".$i."#", $llistaArguments[$i], $retorn );
					}
			} 	
				
		return $retorn;
	}
	
}

?>
