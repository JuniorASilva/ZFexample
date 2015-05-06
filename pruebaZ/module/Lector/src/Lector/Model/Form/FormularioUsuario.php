<?php

namespace Lector\Model\Form;

use Zend\Form\Form;

use Lector\Model\Form\FormularioUsuarioValidator;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class FormularioUsuario extends Form implements ServiceLocatorAwareInterface{
	use ServiceLocatorAwareTrait;
	public function __construct($name=null){
		parent::__construct($name);
	}
	public function init(){
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
			'name'=>'pasword',
			'options'=>array(
				'label'=>'Password:',
			),
			'attributes'=>array(
				'type'=>'password',
				'class'=>'input'
			),
		));
		$this->add(array(
			'name'=>'submit',
			'attributes'=>array(
				'class'=>'btn btn-success',
				'type'=>'submit',
				'value'=>'Registrar',
				'title'=>'Enviar'
			)
		));
		$this->add(array(
			'name'=>'modificar',
			'attributes'=>array(
				'class'=>'btn btn-success',
				'type'=>'submit',
				'value'=>'Modificar',
				'title'=>'Enviar'
			)
		));
	}
}