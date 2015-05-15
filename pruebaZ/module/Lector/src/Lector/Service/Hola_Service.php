<?php
namespace Lector\Service;

class Hola_Service
{
	private $serviceLocator;
	
	public function setsm($sm)
    {
        $this->serviceLocator=$sm;
    }

	public function mostrar(){
		return "hola mundo servicio";
	}
}
?>