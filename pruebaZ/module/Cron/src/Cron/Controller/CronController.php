<?php

namespace Cron\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\MvcEvent;

class CronController extends AbstractActionController
{
    public function indexAction()
    {
        echo "hola desde consola" . PHP_EOL;
    }
}