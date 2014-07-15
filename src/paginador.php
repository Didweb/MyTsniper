<?php

class paginador_SN
{
	private $pagina;
	private $pagpaginador;
	private $totalregistros;
	private $totalpaginas;
	private $regpagina;
	private $primera;
	private $ultima;
	private $previa;
	private $proxima;
	
	public function inicio($totalregistros,$pagina,$rpag=10,$pagpaginador=3)
	{

		
		$this->setTotalregistros($totalregistros,$rpag);
		$this->setRegpagina($rpag);
		$this->setTotalpaginas();
		$this->setPagina($pagina);
		$this->setPrimera();
		$this->setUltima($this->getTotalpaginas());
		$this->setPrevia();
		$this->setProxima();
		$this->setPagpaginador($pagpaginador);
		
	}
	
	public function setPagina($pagina)
	{
		
		$pagsolicitada = $pagina;
		if($pagsolicitada > $this->getTotalpaginas()){
			$pagsolicitada = $this->getTotalpaginas();}
			
		if(isset($_SESSION['pagina'])){
			
			if($pagsolicitada==''){
				$_SESSION['pagina']=1;} 
				else {
				$_SESSION['pagina']=$pagsolicitada;	}
			
			}
			else{
			$_SESSION['pagina']=1; }
		

		
		$this->pagina = $_SESSION['pagina'];
        return $this;
	}


    public function getPagina()
    {
        return $this->pagina;
    }
  

    
    
	public function setPrimera()
	{
		$this->primera = 1;
        return $this;
	}


    public function getPrimera()
    {
        return $this->primera;
    }


	public function setPrevia()
	{
		$this->previa = $this->pagina-1;
        return $this;
	}


    public function getPrevia()
    {
        return $this->previa;
    }
    

	public function setProxima()
	{
		$valor = $this->pagina+1;
		if($valor > $this->getTotalpaginas()) {
			$valor = $this->pagina;
			}
		$this->proxima = $valor;
        return $this;
	}


    public function getProxima()
    {
        return $this->proxima;
    }
    
    
	public function setUltima()
	{
		$this->ultima = $this->getTotalpaginas();
        return $this;
	}


    public function getUltima()
    {
        return $this->ultima;
    }
    
    
	public function setPagpaginador($pagpaginador)
	{	
		$rac='';
		for($n=1;$n<=$pagpaginador;$n++){
				$op=$this->getPagina()-$n;
				if($op<=0) {$op='';}
				
				$rac.=$op; }
				
		$rac = str_split($rac);
		sort($rac);
		$rac = implode("", $rac);
		
		$rac.=$this->getPagina();
		
		for($n=1;$n<=$pagpaginador;$n++){
			
			$op=$this->getPagina()+$n;
			if($op>$this->getTotalpaginas()) {$op='';}
			$rac.=$op; }
		
		$this->pagpaginador = str_split($rac);
        return $this;
	}


    public function getPagpaginador()
    {
        return $this->pagpaginador;
    }   
    
 
    
	public function setTotalregistros($totalregistros)
	{
		$this->totalregistros = $totalregistros;
        return $this;
	}


    public function getTotalregistros()
    {
        return $this->totalregistros;
    }     


	public function setRegpagina($regpagina)
	{
		$this->regpagina = $regpagina;
        return $this;
	}


    public function getRegpagina()
    {
        return $this->regpagina;
    }     


	public function setTotalpaginas()
	{
		$totalpaginas = ceil($this->getTotalregistros()/$this->getRegpagina());
		$this->totalpaginas = $totalpaginas;
        return $this;
	}


    public function getTotalpaginas()
    {
        return $this->totalpaginas;
    }     
	
	
	
}

?>
