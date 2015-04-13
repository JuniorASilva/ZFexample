<?php

namespace Lector\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Db\Adapter\Adapter;

use Lector\Model\Table\ConexionTable;

/**
* 
*/
class LecturaController extends AbstractActionController
{
	public function indexAction(){
		$this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $usuarios=new ConexionTable($this->dbAdapter);
		$data= array("hola"=>"Hola junior desde Zend2",'usu'=>$usuarios->getUsuario());
		return new ViewModel($data);
	}
}
