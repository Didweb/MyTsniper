<?php
require_once('src/mySniper.php');

class Paginacion extends PHPUnit_Framework_TestCase
{
	public $sniper;
	

	
	public function testExisteArchivo()
	{
		$this->assertFileExists('src/paginador.php');
	}
	
	public function setup()
	{
		$_SESSION['pagina'] = ''; 
		 
		$this->sniper = new mySniper();
		$this->sniper->__autoload('paginador');	
	}


	public function testClasePaginador()
	{
		 
		$this->sniper = new mySniper();
		$paginador =  $this->sniper->__autoload('paginador');	
		$this->assertInstanceOf('paginador_SN', $paginador);
	 
	}
	
	public function testCrearPagina()
	{
		
		$totalregistros = 100;
		
		// Recuperamos pagina
		$pagina = 25;
		$this->sniper->clase->inicio($totalregistros,$pagina,$rpag=10,$pagpaginador=3);
	
		$lapagina 		= $this->sniper->clase->getPagina();
		$totalregistros = $this->sniper->clase->getTotalregistros();
		$totalpaginas = $this->sniper->clase->getTotalpaginas();
		$this->assertEquals(100,$totalregistros);
		$this->assertEquals(10,$totalpaginas);
		// Pagina supera el numro de paginas existentes
		$this->assertEquals(10,$lapagina);
		
		// Pagina es 5
		$pagina = 5;
		$this->sniper->clase->inicio($totalregistros,$pagina,$rpag=10,$pagpaginador=3);
		$lapagina 		= $this->sniper->clase->getPagina();
		$this->assertEquals(5,$lapagina);
		
		$inicio = $this->sniper->clase->getInicio();
		$final = $this->sniper->clase->getFinal();
		//$this->assertEquals(51,$inicio);
		//$this->assertEquals(60,$final);
		

		
		$previa 		= $this->sniper->clase->getPrevia();
		$this->assertEquals(4,$previa);
		
		$proxima 		= $this->sniper->clase->getProxima();
		$this->assertEquals(6,$proxima);
		
		$ultima 		= $this->sniper->clase->getUltima();
		$this->assertEquals(10,$ultima);
		
		
		// Pagina es el final
		$pagina = 10;
		$this->sniper->clase->inicio($totalregistros,$pagina,$rpag=10,$pagpaginador=3);
		// proxima si es el final
		$proxima 		= $this->sniper->clase->getProxima();
		$this->assertEquals(10,$proxima);
		
		
		
		// el valor de pagina no se pasa
		$pagina = '';
		$this->sniper->clase->inicio($totalregistros,$pagina,$rpag=10,$pagpaginador=3);
		$lapagina 		= $this->sniper->clase->getPagina();
		$this->assertEquals(1,$lapagina);
		
		$priemra 		= $this->sniper->clase->getPrimera();
		$this->assertEquals(1,$priemra);
		
		$paginador 		= $this->sniper->clase->getPagpaginador();
		$this->assertInternalType('array',$paginador);
		
	
		// con el incio en priemra pagina
		$pagina = 1;
		$this->sniper->clase->inicio($totalregistros,$pagina,$rpag=10,$pagpaginador=3);
		$inicio = $this->sniper->clase->getInicio();
		$this->assertEquals(1,$inicio);
		
	
	}
	
	

}	
?>	
