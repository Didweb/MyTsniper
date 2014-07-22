<?php
require_once('src/mySniper.php');

class ResizeTest extends PHPUnit_Framework_TestCase
{
	public $sniper;
	

	
	public function testExisteArchivo()
	{
		$this->assertFileExists('src/resize.php');
	}
	
	public function setup()
	{
		$this->sniper = new mySniper();
		$this->sniper->__autoload('resize');
		$this->sniper->clase->iniciamos();	
	}

	public function testGetySetDir_destino()
	{
		$this->sniper->clase->setDir_destino('pruebas/fotos-chulas-y');
		$destino = $this->sniper->clase->getDir_destino();
		$this->assertEquals('/var/www/MyTSniper/src/../pruebas/fotos-chulas-y',$destino);
		
	}
	
	
	public function testGetySetPatrones()
	{
		$this->sniper->clase->setPatrones('foo');
		$patron = $this->sniper->clase->getPatrones();
		$this->assertNull($patron);
		
	}
	
	public function testConstruyendo()
	{
		$this->sniper = new mySniper();
		$this->sniper->__autoload('resize');
		$this->sniper->clase->iniciamos('pruebas/fotos-chulas-y','b');	
		$eldir_destino 	= $this->sniper->clase->getDir_destino();	
		$elpatron 		= $this->sniper->clase->getPatrones();
		
		$this->assertEquals( '/var/www/MyTSniper/src/../pruebas/fotos-chulas-y',$eldir_destino);
		$this->assertNull($elpatron);
		
		
	}
	
	
	public function testComprobarPatrones()
	{
		$patron = 'p1,60,100,100,0|p2,100,100,100,0|m,70,150,60,0';
		$this->sniper->clase->setPatrones($patron);
		$elpatron = $this->sniper->clase->getPatrones();
		$this->assertInternalType('array',$elpatron);
		$this->assertEquals('p1',$elpatron[0]['prefijo']);
		
	
	}
	
	public function testComprobarPatronesUnaSolaMedida()
	{
		$patron = 'p1x,60,100,100,0';
		$this->sniper->clase->setPatrones($patron);
		$elpatron = $this->sniper->clase->getPatrones();
		$this->assertInternalType('array',$elpatron);
		$this->assertEquals('p1x',$elpatron[0]['prefijo']);
		
	
	}
	
	
	public function testComprobarCantidadMedidas()
	{
		$patron = 'p1x,60,100,100,0';
		$this->sniper->clase->iniciamos('pruebas/fotos-chulas-y',$patron);
		$n_medidas = $this->sniper->clase->getN_medidas();
		$this->assertInternalType('integer',$n_medidas);
		$this->assertEquals(1,$n_medidas);
		
	
		$patron = 'p1,60,100,100,0|p2,100,100,100,0|m,70,150,60,0';
		$this->sniper->clase->iniciamos('pruebas/fotos-chulas-y',$patron);
		$n_medidas = $this->sniper->clase->getN_medidas();
		$this->assertEquals(3,$n_medidas);
	
	}
	
	
	public function testDirectorios()
	{
		$patron = 'p1,60,100,100,0|p2,100,100,100,0|m,70,150,60,0';
		$this->sniper->clase->iniciamos('pruebas/fotos-chulasx',$patron);
		$directorio = $this->sniper->clase->getDir_destino();
		$this->assertFileExists($directorio.'/index.php');
	}
	
	
	public function testSetDirectorios()
	{
		$patron = 'p1,60,100,100,0|p2,100,100,100,0|m,70,150,60,0';
		$this->sniper->clase->iniciamos('pruebas/fotos-chulasx',$patron);
		$destino = $this->sniper->clase->getDir_destino();
		$patron = $this->sniper->clase->getPatrones();
		$directorio = $this->sniper->clase->setDir($destino,$patron);
		$this->assertFileExists($destino.'/p1/index.php');
		$this->assertFileExists($destino.'/p2/index.php');
		$this->assertFileExists($destino.'/m/index.php');
		
		
	}
	
	
	public function testValidacion()
	{
		$patron = 'p1,60,100,100,0|p2,100,100,100,0|m,70,150,60,0';
		$this->sniper->clase->iniciamos('pruebas/fotos-chulasx',$patron);
		
		// con error $size_ancho
		$validacion = $this->sniper->clase->validacion('a', 200, 'b', 'c', 100, 1 );
		$this->assertFalse($validacion);
		
		// con error $size_alto
		$validacion = $this->sniper->clase->validacion(200, -15, 'b', 'c', 100, 1 );
		$this->assertFalse($validacion);
		
		// con error $save_dir
		$validacion = $this->sniper->clase->validacion(200, 100, '', 'c', 100, 1 );
		$this->assertFalse($validacion);
		
		// con error $save_name
		$validacion = $this->sniper->clase->validacion(200, 100, 'z', '', 100, 1 );
		$this->assertFalse($validacion);
		
		// con error $calidad
		$validacion = $this->sniper->clase->validacion(200, 100, 'z', 'y', 'a', 1 );
		$this->assertFalse($validacion);
		
		
		// con error $calidad
		$validacion = $this->sniper->clase->validacion(200, 100, 'z', 'y', 300, 1 );
		$this->assertFalse($validacion);
		
		// con error $corte
		$validacion = $this->sniper->clase->validacion(200, 100, 'z', 'y', 50, 5 );
		$this->assertFalse($validacion);
		
		
		// Todo correcto
		$validacion = $this->sniper->clase->validacion(200, 100, 'z', 'y', 50, 0 );
		$this->assertTrue($validacion);
	}
	
	
	
}	
?>	
