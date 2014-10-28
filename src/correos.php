<?php

class correos_SN
{
	
	private $destino;
	private $verificar;
	
	private $datos;
	
	public $MenErrorVer = array('errores'=>0,'correo'=>0);
	
	
	
	public function inicio($destino=null,$verificar=null)
	{
	 if($destino==null || $verificar==null){
		
		 $this->MenErrorVer['errorDatos']="Error en los datos, falta Destion o Tipos de verificación";
		 return null; }	
		 else {
			 
		$this->setDestino($destino);	
		$ver = $this->setVerificar($verificar);
		if(is_null ( $ver)) {
			 $this->MenErrorVer['errorDatos2']="Los datos de verificación deben venir en forma de ARRAY";
			return null; 
			}
		}
	}
	
	
	
	public function campos()
	{
		$campos = $this->getVerificar();
		$loscampos = array();
		$n=0;
		foreach ($campos as $nom=>$val){
			$separa = explode("|",$campos[$nom]);
			$loscampos[$n]=array('nombre'=>$separa[0], 'name'=>$separa[1],'verifica'=>$separa[2],'tipo'=>$separa[3]);
			$n++;
		}
		
		return $loscampos;
	}
	
	
	
	public function check()
	{
		if($this->puntear()==null){

		 $this->MenErrorVer['errorVerificacion']="Se han producido errores";	
		} else {
			
		return $this->datos;	
		}
		
	}
	
	
	
	public function puntear()
	{
		$campos = $this->campos();
		$errorpuntear = 0;
		foreach($campos as $nom=>$val){
			
				if (!in_array($campos[$nom]['name'], array_keys($_POST))) {
					$errorpuntear = 1; }
			}
			
		if($errorpuntear==1){
			$this->MenErrorVer['errorPuntear']="Valores No son Un Array";
			return null;
			} else {
			
			// Recogemos todos los campos y los limpiamos de etiquetas html o php
			$datos=array();
			$n=0;
			foreach($_POST as $nom=>$val){
				$eldato = $this->verificar_texto($_POST[$nom]);
				$datos[$n]=array('name'=>$nom,'dato'=>$eldato);
				$n++;
				}
				
				
			// Buscamos los campos con verificacioens especiales y las aplicamos
			
			$this->setDatos($datos);
			foreach($datos as $nom=>$val){
					foreach($campos as $nom2=>$val2){
						
						// Buscar y aplicar verificación de correo valido 	
						if($campos[$nom2]['name']==$datos[$nom]['name'] && $campos[$nom2]['verifica']=='correo'){
							
							$this->verificar_correo($datos[$nom]['dato']);
							}
						}
				}
			
			
			if($this->MenErrorVer['errores']==1){
				
				return null; } else {
					
				return $this->getDatos($datos);}
			
			
			 }
		
	}
	
	
	
	
	public function verificar_texto($texto)
	{
		$limpio = strip_tags($texto);
		return $limpio;
	}
	
	
	public function verificar_correo($texto)
	{
		 $Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
		if(preg_match($Sintaxis,$texto)){
				return true;} 
			else {
			$this->MenErrorVer['errores']	= 1;
			$this->MenErrorVer['correo']	= 1;
			$this->MenErrorVer['errorVerificarCorreo']="Correo no Valido";	
				return false;}
			
		
	}	
	
	
	
	public function setDatos($datos)
	{
		$this->datos = $datos;
		return $this;
	}
	
	public function getDatos()
	{
		return $this->datos;
	}	
	
	public function setDestino($destino)
	{
		if($destino==null){
			return null; }
			else {
			$this->destino = $destino;
			return $this;
			}
	}
	
	public function getDestino()
	{
		return $this->destino;
	}
	
	
	public function setVerificar($verificar)
	{
		
		if(is_array($verificar)){
			$this->verificar = $verificar;
			return $this; } 
			else {
			return null;
		}
		
	}
	
	public function getVerificar()
	{
		return $this->verificar;
	}
	
	
	public function mostrarErrores()
	{
		foreach($this->MenErrorVer as $nom=>$val){
			echo "<br> [$nom] <b style='color:red;'>".$this->MenErrorVer[$nom].'</b>';
			}	
		
	}
	
}
?>
