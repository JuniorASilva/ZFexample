<?php

namespace Lector\Model\Form;

use Zend\Form\Form;

class FormularioUsuario extends Form{
	public function __construct($name=null){
		parent::__construct($name);
		$this->add(array(
			'name'=>'txtNombre',
			'options'=>array(
				'label'=>'Nombre:',
			),
			'attributes'=>array(
				'type'=>'text',
				'class'=>'input'
			),
		));
		$this->add(array(
			'name'=>'txtEmail',
			'options'=>array(
				'label'=>'Email:',
			),
			'attributes'=>array(
				'type'=>'text',
				'class'=>'input'
			),
		));
		$this->add(array(
			'name'=>'submit',
			'attributes'=>array(
				'type'=>'submit',
				'value'=>'Insertar',
				'title'=>'Enviar'
			)
		));
	}
}