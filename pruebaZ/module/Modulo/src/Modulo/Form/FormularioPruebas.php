<?php

namespace Modulo\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
//use Zend\InputFilter\InputFilter;

use Modulo\Form\FormularioPruebasValidator;


class FormularioPruebas extends Form
{
	public function __construct($name = null){
		parent::__construct($name);
		//podemos añadir campos al formulario de esta forma
		$this->setInputFilter(new FormularioPruebasValidator());
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
		$captcha = new Element\Captcha('captcha');
		$captcha->setCaptcha(new Captcha\Dumb());
		$captcha->setLabel('Please verify you are human');
		//$this->add($captcha);

		$this->add(array(
			'name'=>'txtEmail',
			'options'=>array(
				'label'=>'Email: ',
				),
			'attributes'=>array(
				'type'=>'text',
				'class'=>'input',
				'id'=>'campito',
				),
			));
		/*
		$factory=new Factory();

		//creando elementos de una manera similar a la anterior
		$email=$fatory->createElement(array(
			'type'=>'Zend\Form\Element\Email',
			'name'=>'email',
			'options'=>array(
				'label'=>'Email:',
			),
			'attributes'=>array(
				'class'=>'input_email',
				'id'=>'input_email'
			),
		));
		$this->add($email);*/

		//Creamos el boton submit
		$this->add(array(
			'name'=>'submit',
			'attributes'=>array(
				'type'=>'submit',
				'value'=>'Enviar',
				'title'=>'Enviar'
			)
		));
	}
}
?>
