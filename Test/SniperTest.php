<?php
require_once('src/mySniper.php');

class SniperTest extends PHPUnit_Framework_TestCase
{
	public $sniper;
	

	
	public function testExisteArchivo()
	{
		$this->assertFileExists('src/mySniper.php');
	}
	
	public function testInstanciarObjeto()
	{	
		$this->assertInstanceOf('mySniper', new mySniper() );
	}
	
	
	public function testProbarLlamadaClase()
	{	
		$sniper = new mySniper();
		$clase = $sniper->__autoload('mapeatxt');
		$this->assertInstanceOf('mapeatxt_SN', $clase);
	}
	
	public function testProbarLlamadaClaseNull()
	{	
		$sniper = new mySniper();
		$clase = $sniper->__autoload('mapeatxtx');
		$this->assertNull(null,$clase);
	}

}	
?>	
