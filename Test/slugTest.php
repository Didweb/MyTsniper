<?php
require_once('src/mySniper.php');

class SlugTest extends PHPUnit_Framework_TestCase
{
	public $sniper;
	
	
	public function testExisteArchivo()
	{
		$this->assertFileExists('src/slug.php');
	}
	
	public function setup()
	{
		$this->sniper = new mySniper();
		$this->sniper->__autoload('slug');	
	}
	
	public function testSlug()
	{
		$texto = 'áà éè ñÑ';
		$res = $this->sniper->clase->limpiando($texto,$separador = '-');
		$this->assertEquals('aa-ee-nn',$res);
	}
}
?>
