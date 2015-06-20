<?php
/**
 * Created by PhpStorm.
 * User: XVI
 * Date: 01/03/15
 * Time: 15:53
 * Doctrine (db)
 */

$app['zdb.configArray'] = array(
    'driver'   => 'pdo_mysql',
    'database' => 'buvette',
    'charset'  => 'utf8',
    'hostname' => 'localhost',
    'port'     => '3306',
    'username' => 'Raulnet',
    'password' => '',
    'options'  => array(
        'buffer_results' => true,
    )
);