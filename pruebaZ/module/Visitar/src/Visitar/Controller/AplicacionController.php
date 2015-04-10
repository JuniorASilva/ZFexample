<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Visitar\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\I18n\Validator\Alpha;
use Zend\Validator\Hostname;
use Zend\Validator\NotEmpty;

class AplicacionController extends AbstractActionController
{
    public function indexAction()
    {
    	$id = $this->params()->fromRoute("id",null);
    	$data= array("holamundo"=>"Hola desde Zend2","id"=>$id);
        return new ViewModel($data);
    }
    //validacion Alpha
    public function validalphaAction(){
    	$valido = new Alpha(array('allowWhiteSpace' => true));
    	$cad = 'ASlkldf AS ';
    	if($valido->isValid($cad)){
    		$men = $cad."<br>Es valido";
    	}else{
    		$men = $cad."<br>No es valido";
    	}
    	return new ViewModel(array('error'=>$men));
    }
    //valida ip
    public function validhostnameAction(){
    	$vali = new Hostname(Hostname::ALLOW_IP);
    	$host = '192.23.56.5';
    	if($vali->isValid($host)){
    		$men = $host.'<br>host valido';
    	}else{
    		$men = $vali->getMessages();
    	}
    	return new ViewModel(array('error'=>$men));
    }
    //validacion notEmpty
    public function validnotemptyAction(){
    	$valid = new NotEmpty();
    	$cad = '54afd65';
    	if($valid->isValid($cad)){
    		$men = $cad.'<br>Cadena no vacia';
    	}else{
    		$men = $valid->getMessages();
    	}
    	return new ViewModel(array('error'=>$men));
    }
}