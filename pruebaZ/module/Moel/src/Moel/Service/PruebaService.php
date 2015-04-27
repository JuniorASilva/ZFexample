<?php

namespace Moel\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PruebaService implements FactoryInterface{
	public function createService(ServiceLocatorInterface $serviceLocator){
		return new \stdClass();
	}
}
