<?php

namespace Modulo\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator;
use Zend\I18n\Validator as I18nValidator;

class FormularioPruebasValidator extends InputFilter
{

    public function __construct()
    {
        //-- Validacion de Correo Principal
        $this->add(
                array(
                    'name' => 'txtEmail',
                    'required' => TRUE,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'EmailAddress',
                            'options' => array(
                                'messages' => array(
                                    EmailAddress::INVALID_FORMAT => 'Email incorrecto',
                                    EmailAddress::INVALID_HOSTNAME => 'Dominio incorrecto',
                                ),
                            ),
                        ),
                    ),
                ),
        );
        //-- Validacion de Nombres
        $this->add(
                array(
                    'name' => 'txtNombre',
                    'required' => TRUE,
                    'validators' => array(
                        array(
                            'name' => 'Alnum',
                            'options' => array(
                                'allowWhiteSpace' => TRUE,
                            )
                        )
                    )
                )
        );
    }

}

