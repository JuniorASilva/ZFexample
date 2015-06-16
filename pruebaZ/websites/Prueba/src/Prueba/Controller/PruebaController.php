<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Prueba\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PruebaController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function fooAction()
    {
        $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $usuarios = new \Lector\Model\Table\ConexionTable($this->dbAdapter);
        $conex = $usuarios->getUsuario();
        return new ViewModel(array('lista'=>$conex));
        //return array();
    }
}
