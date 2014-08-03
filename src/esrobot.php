<?php

class esrobot_SN
{


    public function esRobot($agente,$rutaTXT) 
    {
        $delimitador = "|#|";
        $archivoRobots = $rutaTXT; //"src/Documentos/LiRobots.txt";
        //Obtener el contenido del archivo como una cadena.
        $str_archivo = file_get_contents($archivoRobots,FILE_USE_INCLUDE_PATH);
        //Convertir cadena a arreglo con ayuda del delimitador
        $lista_robots = explode($delimitador,$str_archivo);
 
		array_pop($lista_robots);

 
        foreach($lista_robots as $robot)    {
            if(strpos($agente, trim($robot) )  !== false)
                return true;
			
        }
        return false;
    }


}	
