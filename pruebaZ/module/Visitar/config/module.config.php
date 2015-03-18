<?php
return array(
	'controllers' => array(
        'invokables' => array(
            'Visitar\Controller\Visitar' => 'Visitar\Controller\VisitarController',
        ),
    ),
    'router' => array(
        'routes' => array(
        	'visitar' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/visitar[/:action][/:id]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'		 => '[a-zA-Z0-9]*',
                            ),
                            'defaults' => array(
                            	'controller'=>'Visitar\Controller\Visitar',
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
            'visitar/visitar/index' => __DIR__ . '/../view/visitar/visitar/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'visitar'=> __DIR__ . '/../view',
        ),
    ),
);