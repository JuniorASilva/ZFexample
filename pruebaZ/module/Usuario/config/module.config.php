<?php
return array(
	'controllers' => array(
        'invokables' => array(
            'Usuario\Controller\Usuario' => 'Usuario\Controller\UsuarioController',
        ),
    ),
    'router' => array(
        'routes' => array(
        	'usuario' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/usuario',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
                        'controller'    => 'Usuario',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
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
            'usuario/usuario/index' => __DIR__ . '/../view/usuario/usuario/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'usuario'=> __DIR__ . '/../view',
        ),
    ),
);