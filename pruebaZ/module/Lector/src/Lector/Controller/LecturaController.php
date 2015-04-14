<?php

namespace Lector\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Db\Adapter\Adapter;

use Lector\Model\Table\ConexionTable;

use Lector\Model\Form\FormularioUsuario;

use Zend\I18n\Validator as I18nValidator;

/**
* 
*/
class LecturaController extends AbstractActionController
{
	public function indexAction(){
        $form = new FormularioUsuario();
		$data = array('form'=>$form,'url'=>$this->getRequest()->getBaseUrl());
		return new ViewModel($data);
	}

	public function insercionAction(){
		if($this->getRequest()->isPost()) {
			$form = new FormularioUsuario();
			$datos = $this->request->getPost();
			$form->setData($datos);
			if($form->isValid()){
				$this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		        $usuarios = new ConexionTable($this->dbAdapter);
		        $nombre=$this->request->getPost("txtNombre");
		        $email=$this->request->getPost("txtEmail");
		        $usuarios->setUsuario($nombre,$email);		
				$data = array('hecho'=>"Insercion Satisfactoria");
				return new ViewModel($data);
			}
			else{
				$men = $form->getMessages();
				return new ViewModel(array('error'=>$men));
			}
		}
		else{
			return $this->redirect()->toUrl(
    			$this->getRequest()->getBaseUrl().'/lector/lectura/index'
    		);
		}
	}
	public function listarAction(){
		$this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$usuarios = new ConexionTable($this->dbAdapter);
		$conex = $usuarios->getUsuario();
		return new ViewModel(array('lista'=>$conex));
	}
}
