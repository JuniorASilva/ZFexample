<?php

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\InitializerInterface;

class MyInitializer implements InitializerInterface
{
	public function initialize($instance, ServiceLocatorInterface $serviceLocator)
	{
		if($instance instanceof \stdClass){
			$instance->initialized = 'inicializado!';
		}
	}
}
