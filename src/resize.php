<?php

class resize_SN
{
	
	private $dir_destino;
	private $patrones;
	private $n_medidas;

	
	public function iniciamos($dir_destino = null, $patrones = null)
	{
		if($dir_destino != null && $patrones != null){
		$this->setDir_destino($dir_destino);
		$this->setPatrones($patrones);	
		
		$getpatrones = $this->getPatrones();
		if($getpatrones != null){
			$this->setN_medidas();
			$this->setDir($this->getDir_destino(),$this->getPatrones());
			}
		}
	}
	
	
	public function resizeImg($tmpname,$save_name, $nombre_enviado)
	{
		$patrones = $this->getPatrones();
		$formatos_permitidos = "jpg,JPG,jepg,JEPG,png,PNG,gif,GIF";
		
		// Extraer formato.	
        $ext = substr(strrchr($nombre_enviado, "."),1);
        $ext = strtolower($ext);
			
		$valida_formato = strpos($formatos_permitidos,$ext);
		
		
		$save_name = str_replace("_", "", $save_name);
		
		// Validamos el formato
		if($valida_formato !== false){	
			$nombre = $save_name.'.'.$ext;
				foreach($patrones as $nom=>$val){
					$save_name	='';
					$prefijo 	= '';
					$prefijo	= $patrones[$nom]['prefijo'];
					$size_ancho = (int)$patrones[$nom]['ancho'];
					$size_alto  = (int)$patrones[$nom]['alto'];
					$save_dir   = $this->getDir_destino().'/'.$prefijo;
					$save_name  = $prefijo.'_'.$nombre;
					$calidad	= (int)$patrones[$nom]['calidad'];
					$corte		= $patrones[$nom]['corte'];
					
					
					// renombrar por si el nombre ya existe y eviatr sobre escribir archivo.
					$save_name = $this->checkeoNombre($save_name,$save_dir);
					
					
					$valida = $this->validacion($size_ancho, $size_alto, $save_dir, $save_name, $calidad, $corte );
					// validamos parámetros.
					if($valida == true){
						
							if($corte==1){
								
									$pImageDestino = $save_dir.'/'.$save_name;
									$this->img_resize_corte($tmpname,  $pImageDestino,  $size_ancho, $size_alto, $calidad); } 
							
							elseif($corte==0){
									
									$this->img_resize( $tmpname, $size_ancho, $size_alto, $save_dir, $save_name, $calidad ); }
					
					}else {
						echo " <br>Los parámetros son incorrectos, recuerda los paraámetros tiene este formato: <br><b>DIRECTORIO,CALIDAD,ANCHO,ALTO,CORTE</b>";
						}	
		}
		$save_name = explode('_',$save_name);
		$trozos = count($save_name);
		if($trozos == 2){
			$nomfinal = $save_name[1];
			
			} elseif ($trozos == 3) {
			$nomfinal =  $save_name[1].'_'.$save_name[2];	
			}
		
		return $nomfinal;
		} else {
			echo " <br>Formato no permitido, formatos permitidos: <br><b>$formatos_permitidos</b>";
			} 
		
		
		
		
	}
	
	
	
	public function img_resize( $tmpname, $size_ancho, $size_alto, $save_dir, $save_name, $calidad )
	{
	   $size = $size_ancho;	
	    $save_dir .= ( substr($save_dir,-1) != "/") ? "/" : "";
	    $gis       = GetImageSize($tmpname);
	    $type       = $gis[2];
	   
	    switch($type)
		{
		case "1": $imorig = imagecreatefromgif($tmpname); break;
		case "2": $imorig = imagecreatefromjpeg($tmpname);break;
		case "3": $imorig = imagecreatefrompng($tmpname); break;
		default:  $imorig = imagecreatefromjpeg($tmpname);
		}

		$x = imageSX($imorig);
		$y = imageSY($imorig);
		
			//if($gis[0]<$gis[1])
		if($gis[0] <= $size)
				{
				$av = $x;
				$ah = $y;
				}
				else
				{
				//aplicar el tamaño de alto en caso de que la foto sea mas alta que larga	
				if($gis[0]<$gis[1])
				{$size=$size_alto;}
				
				$yc = $y*1.3333333;
				$d = $x>$yc?$x:$yc;
				$c = $d>$size ? $size/$d : $size;
				$av = $x*$c;        
				$ah = $y*$c;        
				}  
		
		$im = imagecreate($av, $ah);
		$im = imagecreatetruecolor($av,$ah);
			//para fondo blanco
			$blanco = imagecolorallocate($im, 255, 255, 255);
			imagefill($im, 0, 0, $blanco);
			//fin para fondo blanco
	    if (imagecopyresampled($im,$imorig , 0,0,0,0,$av,$ah,$x,$y))
		if (imagejpeg($im, $save_dir.$save_name,$calidad))
		    return true;
		    else
		    return false;
	    }

	
	
	
	function img_resize_corte($tmpname,  $pImageDestino,  $size_ancho, $size_alto, $calidad)
	{
	
	$datosi		= getimagesize($tmpname); 
	$pWidth		= $datosi[0]; 
	$pHeight	= $datosi[1];
	$type       = $datosi[2];

		// SI WIDTH ES MAS ALTO, LO CORTO POR WIDTH Y VICEVERSA
		if($pWidth > $pHeight){
			$_porcentaje 	= $size_alto*100/$pHeight;
			$_height 		= $size_alto;
			$_width 		= ceil($_porcentaje*$pWidth/100);
		}else{
			//echo "<br /><strong> $_porcentaje = $pMaxWidth * 100 / $pWidth </strong>";
			$_porcentaje 	= $size_ancho*100/$pWidth;
			$_width 		= $size_ancho;
			$_height 		= ceil($_porcentaje*$pHeight/100);
		}
		
		// PARA QUE ACEPTE VARIOS FORMATOS
		switch($type)
        {
        case "1": $_pic = @imagecreatefromgif($tmpname); break;
        case "2": $_pic = @imagecreatefromjpeg($tmpname);break;
        case "3": $_pic = @imagecreatefrompng($tmpname); break;
        default:  $_pic = @imagecreatefromjpeg($tmpname);
        }

		
		$_tmp = imagecreatetruecolor($size_ancho, $size_alto);
		$blanco = imagecolorallocate($_tmp, 255, 255, 255);
		imagefill($_tmp, 0, 0, $blanco);
		
		imagecopyresampled($_tmp, $_pic, 0, 0, 0, 0, $_width, $_height, $pWidth, $pHeight);

		
		if (imagejpeg($_tmp, $pImageDestino, $calidad))
            return true;
           else
            return false;
	
	} 
	
	public function checkeoNombre($save_name,$save_dir)
	{
		$exp_original = explode('_',$save_name);
		$contador = 0;
		$directorio=opendir($save_dir); 

		while ($archivo = readdir($directorio)){
			
		  if($archivo !='.' && $archivo!='..'){
				  
				$mont_nom = explode('_',$archivo);
				$cuenta =count($mont_nom);
				
				if($cuenta==3){
					
						if($mont_nom[2] ==  $exp_original[1])
								{ $contador++; }	
						
					} elseif ($cuenta==2) {
						
						if($mont_nom[1] ==  $exp_original[1]  )
								{ $contador++; }
						
						}
				}
			
			
			}
			
		$save_name = $exp_original[0].'_'.$contador.'_'.$exp_original[1];
		closedir($directorio); 
		
		return $save_name;
		
	}
	
	
	
	public function validacion($size_ancho, $size_alto, $save_dir, $save_name, $calidad, $corte )
	{
		
		$validacion_aprovada = true;
		// size_ancho y size_alto debe ser un entero.
		if(!is_int($size_ancho) || $size_ancho<=0)
			{$validacion_aprovada = false;
			echo "<br>Error! size_ancho = $size_ancho | Tipo: ".gettype($size_ancho)."<br>"; }
		
		if(!is_int($size_alto) || $size_alto<=0)
			{$validacion_aprovada = false; echo "<br>Error! size_alto = $size_alto | Tipo: ".gettype($size_alto)."<br>"; }
		
		if($save_dir=='' || $save_name=='')
			{$validacion_aprovada = false; echo "<br>Error! save_name = $save_name | save_dir = $save_dir | Estos valores deben contener una cadena. <br>"; }
		
		if(!is_int($calidad) || $calidad<=0 || $calidad>100)
			{$validacion_aprovada = false; echo "<br>Error! calidad = $calidad | Tipo: ".gettype($calidad)." (Debe ser mayor de 0 y menor de 100 y tipo integer)<br>"; }
		
		if($corte!=0 && $corte!=1)
			{$validacion_aprovada = false; echo "<br>Error! corte = $corte | Tiene que tener el valor 0 ó 1 <br>"; }
			
		return 	$validacion_aprovada;
	}
	
	
	public function setDir($dir_destino,$patrones)
	{
		foreach($patrones as $nom=>$val){
		$dir = $dir_destino.'/'.$patrones[$nom]['prefijo'];
			if(!is_dir($dir)){
				mkdir($dir, 0777);
				if(!is_file($dir."/index.php")){
					fopen($dir."/index.php","w+");
					}
				} 
		}
		
	}
	
	
	
	
	
	
	public function setN_medidas()
	{
		$cuenta = $this->getPatrones();
		if($cuenta == null ){
			$cuenta = 0;
			} else {
			$cuenta = count($cuenta);
			}
		$this->n_medidas = (int)$cuenta;
		return $this;
		
	}
	
	public function getN_medidas()
	{
		return $this->n_medidas;
	}
	
	
	
	public function setDir_destino($valor)
	{
		
		if(!is_dir($valor)){
			mkdir($valor, 0777);
			fopen($valor."/index.php","w+");
			} 
		$this->dir_destino = $valor;	
		return $this;
	}
	
	
	public function getDir_destino()
	{
		return $this->dir_destino;
	}

	
	public function setPatrones($valor)
	{
		$lospatrones = array();
		$n=0; 

		$pos = stripos($valor,',' );
		$pos2 = stripos( $valor,'|');
		
		if($pos === false)
		{$lospatrones = null; }else{
		if($valor != null || $valor!='' ){
		
		if($pos2 !== false){
			$valor = explode('|',$valor);
			foreach ($valor as $nom =>$val){
						$prefijo 	= '';
						$calidad 	= '';
						$ancho 		= '';
						$alto 		= '';
						$corte 		= '';
						
				$valor2 =explode(',',$valor[$nom]);
			if(count($valor2)==5){	
					if(isset($valor2[0])) { $prefijo 	= $valor2[0]; }
					if(isset($valor2[1])) { $calidad 	= $valor2[1]; }
					if(isset($valor2[2])) { $ancho 		= $valor2[2]; }
					if(isset($valor2[3])) { $alto 		= $valor2[3]; }	
					if(isset($valor2[4])) { $corte 		= $valor2[4]; }	
					
					$lospatrones[$n]=array(
									'prefijo'	=> $prefijo,
									'calidad'	=> $calidad,
									'ancho'		=> $ancho,
									'alto'		=> $alto,
									'corte'		=> $corte
									
									);
					$n++;
				}				
				}
			
			} else {
				
				
					$prefijo 	= '';
					$calidad 	= '';
					$ancho 		= '';
					$alto 		= '';
					$corte 		= '';
					
				$valor2 =explode(',',$valor);
			if(count($valor2)==5){	
				if(isset($valor2[0])) { $prefijo 	= $valor2[0]; }
				if(isset($valor2[1])) { $calidad 	= $valor2[1]; }
				if(isset($valor2[2])) { $ancho 		= $valor2[2]; }
				if(isset($valor2[3])) { $alto 		= $valor2[3]; }	
				if(isset($valor2[4])) { $corte 		= $valor2[4]; }		
						
				$lospatrones[$n]=array(
								'prefijo'	=> $prefijo,
								'calidad'	=> $calidad,
								'ancho'		=> $ancho,
								'alto'		=> $alto,
								'corte'		=> $corte
								);
				}				
				
			}
			
			
			
				
			} else { $lospatrones = null;}
		}
		
		$this->patrones = $lospatrones;
		return $this;
	}
	
	
	public function getPatrones()
	{
		return $this->patrones;
	}
	
	

}

?>
