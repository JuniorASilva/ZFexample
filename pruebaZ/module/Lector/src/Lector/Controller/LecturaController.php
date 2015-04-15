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
				return $this->redirect()->toUrl(
					$this->getRequest()->getBaseUrl().'/lector/lectura/listar'
				);
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
	public function eliminarAction(){
		$this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$usuarios = new ConexionTable($this->dbAdapter);
		$id=$this->params()->fromRoute("id",null);
		$usuarios->eliminar($id);
		return $this->redirect()->toUrl(
    		$this->getRequest()->getBaseUrl().'/lector/lectura/listar'
    	);
	}
	public function verAction(){
		$form = new FormularioUsuario();
		$id=$this->params()->fromRoute("id",null);
		$this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$usuarios = new ConexionTable($this->dbAdapter);
		$result = $usuarios->getUnUsuario($id);
		$data = array('form'=>$form,'datos'=>$result,'id'=>$id,'url'=>$this->getRequest()->getBaseUrl());
		return new ViewModel($data);
	}
	public function modificarAction(){
		if($this->getRequest()->isPost()){
			$form = new FormularioUsuario();
			$datos = $this->request->getPost();
			$form->setData($datos);
				$this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
				$usuarios = new ConexionTable($this->dbAdapter);
				$nombre=$this->request->getPost("txtNombre");
		        $email=$this->request->getPost("txtEmail");
				$id=$this->params()->fromRoute("id",null);
				$usuarios->modificar($nombre,$email,$id);
				return $this->redirect()->toUrl(
					$this->getRequest()->getBaseUrl().'/lector/lectura/listar'
				);
				$men=$form->getMessages();
				return $this->redirect()->toUrl(
		    		$this->getRequest()->getBaseUrl().'/lector/lectura/ver/'.$this->params()->fromRoute("id",null)
		    	);
			
		}
		else{
			return $this->redirect()->toUrl(
    		$this->getRequest()->getBaseUrl().'/lector/lectura/listar'
    	);
		}
	}
}