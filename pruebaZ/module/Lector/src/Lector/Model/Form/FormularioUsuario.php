<?php

namespace Lector\Model\Form;

use Zend\Form\Form;

use Lector\Model\Form\FormularioUsuarioValidator;

class FormularioUsuario extends Form{
	public function __construct($name=null){
		parent::__construct($name);

		//insertamos el validator
		$this->setInputFilter(new FormularioUsuarioValidator());

		//armamos el formulario
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
				'class'=>'btn btn-success',
				'type'=>'submit',
				'value'=>'Insertar',
				'title'=>'Enviar'
			)
		));
	}
}