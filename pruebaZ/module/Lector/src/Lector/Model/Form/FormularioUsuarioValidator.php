<?php

namespace Lector\Model\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator;
use Zend\Validator\EmailAddress;
use Zend\Validator\StringLength;
use Zend\I18n\Validator\Alpha;
use Zend\I18n\Validator as I18nValidator;

class FormularioUsuarioValidator extends InputFilter
{

    public function __construct()
    {
        //-- Validacion de Correo Principal
        $this->add(
                array(
                    'name' => 'txtEmail',
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'EmailAddress',
                            'options' => array(
                                'allowWhiteSpace'=>true,
                                'messages' => array(
                                    EmailAddress::INVALID => 'Ingresa un buen email mrd',
                                    EmailAddress::INVALID_FORMAT => 'Email incorrecto',
                                    EmailAddress::INVALID_HOSTNAME => 'Dominio incorrecto',
                                )
                            )
                        )
                    )
                )
        );
        //-- Validacion de Nombres
        $this->add(
                array(
                    'name' => 'txtNombre',
                    'validators' => array(
                        array(
                            'name' => 'Alnum',
                            'options' => array(
                                'allowWhiteSpace' => TRUE,
                            )
                        ),
                        array (
		                    'name' => 'StringLength',
		                    'options' => array(
		                        'encoding' => 'UTF-8',
		                        'min' => '5',
		                        'max' => '15',
		                        'messages' => array(
		                        StringLength::INVALID=>'Tu nombre esta mal',
		                        StringLength::TOO_SHORT=>'Tu nombre debe ser de más de 5 letras',
		                        StringLength::TOO_LONG=>'Tu nombre debe ser de menos de 15 letras',
		                        ),
		                    ),
		                ),
                    )
                )
        );
    }

}


