<?php
require_once('src/mySniper.php');

class ArrayOrderTest extends PHPUnit_Framework_TestCase
{
	public $sniper;
	

	
	public function testExisteArchivo()
	{
		$this->assertFileExists('src/arrayorder.php');
	}
	
	public function setup()
	{
		$this->sniper = new mySniper();
		$this->sniper->__autoload('arrayorder');	
	}

	
	public function test_Array_Orderby_EsUnArray()
	{
		
		
		$array[0] = array('valorA'=>'a','valorB'=>'b','valorC'=>'c','valorD'=>'d');
		
		$res = $this->sniper->clase->array_orderby($array, 'valorC' ,SORT_DESC);
		
		$this->assertInternalType('array', $res);
		
		
	}
	
	
	public function test_Shuffle_Assoc_UnArray()
	{
		
		
		$array[0] = array('valorA'=>'a','valorB'=>'b','valorC'=>'c','valorD'=>'d');
		
		$res = $this->sniper->clase->shuffle_assoc($array);
		
		$this->assertInternalType('array', $res);
		
		
	}	
	
	
	public function test_Duplicados()
	{
		
		
			$matriz[] =array('nombre'=>'pepito','apellido'=>'gomez');
			$matriz[] =array('nombre'=>'juan','apellido'=>'soto');
			$matriz[] =array('nombre'=>'pepito','apellido'=>'fernandez');
			$matriz[] =array('nombre'=>'pedro','apellido'=>'hernan');
		
		$res = $this->sniper->clase->elimina_duplicados($matriz,'nombre');
		
		$this->assertEquals('pedro', $res[2]['nombre']);
		
		
	}	
	
}	
?>	
