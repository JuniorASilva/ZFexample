<?php
return array(
	'controllers' => array(
        'invokables' => array(
            'Modulo\Controller\Prueba' => 'Modulo\Controller\PruebaController',
        ),
    ),
    'router' => array(
        'routes' => array(
        	'modulo' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/modulo[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            	'controller'=>'Modulo\Controller\Prueba',
                            	'action'	=>'index',
                            ),
                        ),
                    ),
            ),
        ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'modulo/prueba/index' => __DIR__ . '/../view/modulo/prueba/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'modulo'=> __DIR__ . '/../view',
        ),
    ),
);