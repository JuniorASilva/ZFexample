<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Modulo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


use Modulo\Form\FormularioPruebas;

use Zend\Validator\EmailAddress;
use Zend\Validator\StringLength;
use Modulo\Form\FormularioPruebasValidator;
use Zend\I18n\Validator as I18nValidator;
use Zend\I18n\Validator\Alnum;
//use Zend\I18n\Validator\StringLength;

class PruebaController extends AbstractActionController
{
    public function indexAction()
    {
    	$data= array("holamundo"=>"Hola junior desde Zend2");
        return new ViewModel($data);
    }
    public function holaAction(){
    	$mode = new Modelo();
    	$data = array("hi"=>"Hola desde mi modelo","mod"=>$mode->getTexto());
    	return new ViewModel($data);
    }

    public function validatoAction(){
        $valid = new FormularioPruebasValidator();
        if ($valid->isValid('jsilvap22gmail.com')) {
            // email appears to be valid
        } else {
            // email is invalid; print the reasons
            $valida = $valid->getMessages();
    //        foreach ($validator->getMessages() as $messageId => $message) {
    //            echo "Validation failure '$messageId': $message\n";
    //        }
        }
        return new ViewModel(array('error'=>$valida));
    }

    public function formularioAction()
    {

    	//creamos el objeto del formulario
    	$form=new FormularioPruebas("form");

    	//le pasamos a la vista el formulario
    	return new ViewModel(array(
    	    'titulo'=>'Formularios en ZF2',
    	    'form'=>$form,
    	    'url'=>$this->getRequest()->getBaseUrl(),
    	));
    }
    public function recibirormularioAction(){
	//este metodo se encarga de recojer los datos de el formulario
	//si a sido enviado y si redirecciona al formulario
        $form=new FormularioPruebas("form");

    	if($this->request->getPost('submit')){
            $datos = $this->request->getPost();
    		$form->setData($datos);
            $men='El correo ';
            //$val=new FormularioPruebasValidator();
            if($form->isValid()) {$men = $men . 'es valido';}
            else {$men = $form->getMessages();}
    		return new ViewModel(array('titulo'=>'Recibir datos via POST EN ZF2','datos'=>$datos,'mensaje'=>$men));
    	}else{
    		return $this->redirect()->toUrl(
    			$this->getRequest()->getBaseUrl().'/modulo/prueba/formulario'
    		);
    	}
    }
    //valida un correo y se le puede asiganar un mensaje
    public function validcorreoAction(){
        $validator = new EmailAddress();

        $validator->setMessage('pon un buen correo',EmailAddress::INVALID_FORMAT);
        if ($validator->isValid('jsilvap22gmail.com')) {
            // email appears to be valid
        } else {
            // email is invalid; print the reasons
            $valida = $validator->getMessages();
    //        foreach ($validator->getMessages() as $messageId => $message) {
    //            echo "Validation failure '$messageId': $message\n";
    //        }
        }
        return new ViewModel(array('error'=>$valida));
    }
    //Valida la longitud de caracteres 
    public function validlongitudAction(){
        $validator = new StringLength(8);
        $validator->setMessage('muy corto',StringLength::TOO_SHORT);
        if (!$validator->isValid('silva')) {
            $messages = $validator->getMessages();            
        }
        return new ViewModel(array('error'=>$messages));
    }
    //validador alnum
    public function validalnumAction(){
        $validator = new Alnum();
        $men = '';
        $cadena = 'Abcd12+}}';
        if ($validator->isValid($cedena)) {
            $men = $cadena. "<br>es valido";
                // value contains only allowed chars
            } else {
                $men = $cadena."<br>no es valido";
                // false
            }
        return new ViewModel(array('error'=>$men));
        }
}
