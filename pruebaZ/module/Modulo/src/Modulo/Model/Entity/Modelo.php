<?php

namespace Modulo\Model\Entity;

class Modelo
{
	private $texto;

	public function __construct(){
		$this->texto = 'Hola desde mi modelo 2';
	}
	public function getTexto(){
		return $this->texto;
	}
}
?>
