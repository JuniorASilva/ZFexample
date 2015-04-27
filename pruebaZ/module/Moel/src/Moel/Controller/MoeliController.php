<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Moel for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Moel\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

//use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceManager;
use Moel\Service\PruebaService;
use Moel\Service\Prueba2Service;
use Zend\ServiceManager\InitializerInterface;

class MoeliController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function fooAction()
    {
        $servicemanager = new InitializerInterface();
        $servicemanager->addInitializer('MyInitializer');
        $servicemanager->setInvokableClass('my-service','stdClass');

        $valor=var_dump($servicemanager->get('my-service')->initialized);
        return new ViewModel(array('valor'=>$valor));
    }
    public function holaAction()
    {
        //$servicemanager = new ServiceManager();
        //$servicemanager->setFactory('foo-service-name',new PruebaService());
        //$serviceManager->setFactory('bar-service-name', 'MyFactory');
        //$serviceManager->setFactory('baz-service-name', function () { return new \stdClass(); });

        //$valor1=var_dump($servicemanager->get('foo-service-name'));
        //$valor2=var_dump($servicemanager->get('bar-service-name'));
        //$valor3=var_dump($servicemanager->get('baz-service-name'));
        $valor1 = md5("");
        setcookie('cookie',$valor1);
        $valor2 = $_COOKIE['cookie'].'';
        $valor3 = md5("junior aldair");
        //flog('error',array('junior'=>'error'));
        return new ViewModel(array('valor1'=>$valor1,'valor2'=>$valor2,'valor3'=>$valor3,"hi"=>"Hola desde mi modulo"));
    }
}
