<?php

class mySniper
{
	public $clase;

	function __autoload( $nombreClase ){
		
		if(file_exists( __DIR__.'/'.$nombreClase . '.php' )){
			require_once( $nombreClase . '.php' );
			$nomclase = $nombreClase.'_SN';
			$clase = new $nomclase();
			
			$this->clase = $clase;
			
			return $clase;
			
			} else {
				$men = "Se ha producido un <b style='color:red'>ERROR</b> <br /> 
						<br /> La clase $nombreClase no existe.";
						
				
				return  null;
		}
	}

}
	

?>
