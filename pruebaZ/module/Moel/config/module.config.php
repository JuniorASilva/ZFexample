<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Moel\Controller\Moeli' => 'Moel\Controller\MoeliController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'moel' => array(
                'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/moel[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller'=>'Moel\Controller\Moeli',
                                'action'    =>'index',
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
            'moel/moeli/index' => __DIR__ . '/../view/moel/moeli/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'Moel' => __DIR__ . '/../view',
        ),
    ),
);
