<?php

class formatostxt_SN
{
	




	public function links($text,$clase,$destino = '_blank')
	{
		$text =preg_replace('/@{1}(.*)@(.*)@/U', '<a href="\\2" target="'.$destino.'"  class="'.$clase.'" >\\1</a>', $text);
		return $text;

	}
	
}
?>
