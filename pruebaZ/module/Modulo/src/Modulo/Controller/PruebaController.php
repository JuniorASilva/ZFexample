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
//use Zend\I18n\Validator as I18nValidator;

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

    	if($this->request->getPost('submit')){
    		$datos=$this->request->getPost();
            $men='El correo ';
            $val=new EmailAddress();
            if($val->isValid($datos)) {$men = $men . 'es valido';}
            else {$men = $val->getMessages();}
    		return new ViewModel(array('titulo'=>'Recibir datos via POST EN ZF2','datos'=>$datos,'mensaje'=>$men));
    	}else{
    		return $this->redirect()->toUrl(
    			$this->getRequest()->getBaseUrl().'/modulo/prueba/formulario'
    		);
    	}
    }
}
