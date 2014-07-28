<?php

class arrayorder_SN
{
	
	// Ordenar array por...
	// $this->array_orderby($nube, 'contador', SORT_DESC);
	// En este ejemplo ordena $nube por el campo 'contador' de forma descendente.
	// Para arrays multidimensional y asociativo. Ver documentacion.
	public function array_orderby()
	{
		$args = func_get_args();
		$data = array_shift($args);
		foreach ($args as $n => $field) {
			if (is_string($field)) {
				$tmp = array();
				foreach ($data as $key => $row)
					$tmp[$key] = $row[$field];
				$args[$n] = $tmp;
				}
		}
		$args[] = &$data;
		call_user_func_array('array_multisort', $args);
		return array_pop($args);
	}
	
	
	
	// Desordenar arrays asociativos orden aleatorio.
	public function shuffle_assoc($list) 
	{ 
	  if (!is_array($list)) return $list; 

	  $keys = array_keys($list); 
	  shuffle($keys); 
	  $random = array(); 
	  foreach ($keys as $key) 
		$random[$key] = $list[$key]; 

	  return $random; 
	} 
	
	
	// Elimina duplicados de un array
	public function elimina_duplicados($array, $campo)
	{
		  foreach ($array as $sub)
		  {
			$cmp[] = $sub[$campo];
		  }
	  $unique = array_unique($cmp);
		  foreach ($unique as $k => $campo)
		  {
			$resultado[] = $array[$k];
		  }
	  return $resultado;
	}
	
	
}
?>	
