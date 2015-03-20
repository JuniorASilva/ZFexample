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
//use Modulo\Model\Entity\Modelo;
//use Modulo\Form\FormularioPruebas;

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
    public function  formularioAction(){
	//creamos el objeto del formulario
	$form=new FormularioPruebas("form");

	//le pasamos a la vista el formulario
	return new ViewModel(array(
	    'titulo'=>'Formularios en ZF2',
	    'form'=>$form,
	    'url'=>$this->getRequest()->getBaseUrl()
	));
    }
    public funtion recibitFormularioAction(){
	//este metodo se encarga de recojer los datos de el formulario
	//si a sido enviado y si redirecciona al formulario

	if($this->request->getPost('submit')){
		$datos=$this->request->getPost();
		return new ViewModel(array('titulo'=>'Recibir datos via POST EN ZF2','datos'=>$datos));
	}else{
		return $this->redirect()->toUrl(
			$this->getRequest()->getBaseUrl().'/modulo/formulario'
		);
	}
    }
}
