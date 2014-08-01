<?php
require_once('src/mySniper.php');

class AleatorioTest extends PHPUnit_Framework_TestCase
{
	public $sniper;
	

	
	public function testExisteArchivo()
	{
		$this->assertFileExists('src/ale.php');
	}
	
	public function setup()
	{
		$this->sniper = new mySniper();
		$this->sniper->__autoload('aleatorio');	
	}


	
}	
?>	
