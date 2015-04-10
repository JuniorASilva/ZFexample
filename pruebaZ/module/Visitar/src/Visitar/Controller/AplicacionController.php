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
}