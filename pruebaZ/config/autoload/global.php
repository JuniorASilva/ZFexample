<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    // ...
    'db' => array(
        'driver' => 'pdo_mysql',
        'hostname' => 'mysql.hostinger.es',
        'database' => 'u977737126_bd',
        'username' => 'u977737126_user',
        'password' => 'Jsilvap22',
        'port' => '3306',
        'options' => array('buffer_results' => true),
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\''
            )
        ),
    /*'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=Junior;host=localhost',
        'username' => 'root',
        'password' => 'Jsilvap22',            
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),*/
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
