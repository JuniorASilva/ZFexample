<?php
return array(
	'controllers' => array(
        'invokables' => array(
            'Lector\Controller\Lectura' => 'Lector\Controller\LecturaController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Lector\Controller\Lectura',
                        'action'     => 'index',
                    ),
                ),
            ),
        	'lector' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/lector',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Lector\Controller',
                        'controller'    => 'Lectura',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[a-zA-Z0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
                /*
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/controller[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Modulo\Controller',
                                'controller'    => 'Prueba',
                                'action'        => 'index',
                            	//'controller'=>'Modulo\Controller\Prueba',
                            	//'action'	=>'index',
                            ),
                        ),*/
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
            'lector/lectura/index' => __DIR__ . '/../view/lector/lectura/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'lector'=> __DIR__ . '/../view',
        ),
    ),
);