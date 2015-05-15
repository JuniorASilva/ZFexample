<?php
namespace Lector;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\EventManager\StaticEventManager,
    Zend\Mvc\Router\RouteMatch;

class Module implements AutoloaderProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public  function  getServiceConfig () 
    { 
        return  array ( 
            'abstract_factories'  =>  array (), 
            'aliases'  =>  array (
                'holaService' => 'Lector\Service\Hola_Service',
                ), 
            /*'factories'  =>  array (
                'Lector\Service\Hola_Service' => function () {
                    //$config = $sm->get('config');
                    return new \Lector\Service\Hola_Service();
                }
            ),*/ 
            'invokables'  =>  array (), 
            'services'  =>  array (), 
            'shared'  =>  array (), 
        ); 
    } 
}
