<?php
require_once('src/mySniper.php');

class MapeaTest extends PHPUnit_Framework_TestCase
{
	public $sniper;
	

	
	public function testExisteArchivo()
	{
		$this->assertFileExists('src/mapeatxt.php');
	}
	
	public function setup()
	{
		$this->sniper = new mySniper();
		$this->sniper->__autoload('mapeatxt');	
	}

	
	public function testComprobarUnParametros()
	{
		
		
		$ParametroUno = 'VALOR INSERTADO';
		$txt = 'Queresmos este Valor aqui --> %1 <--';
		
		$res = $this->sniper->clase->mapeatxt($txt,$ParametroUno);
		
		$this->assertEquals('Queresmos este Valor aqui --> VALOR INSERTADO <--',$res);
		
		
	}
	
	
	public function testComprobarVariosParametros()
	{
		$ParametroUno = 'VALOR INSERTADO-1';
		$ParametroDos = 'VALOR INSERTADO-2';
		$ParametroTres = 'VALOR INSERTADO-3';
		$txt = 'Queresmos este Valor aqui 1--> %1 <-- 2--> %2 <-- 3--> %3 <--';
		
		$res = $this->sniper->clase->mapeatxt($txt,$ParametroUno,$ParametroDos,$ParametroTres);
		
		$this->assertEquals('Queresmos este Valor aqui 1--> VALOR INSERTADO-1 <-- 2--> VALOR INSERTADO-2 <-- 3--> VALOR INSERTADO-3 <--',$res);
		
		
	}
	
}	
?>	
