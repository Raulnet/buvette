<?php
/**
 * Created by PhpStorm.
 * User: XVI
 * Date: 01/03/15
 * Time: 15:53
 * Doctrine (db)
 */
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'microcms',
    'user'     => 'root',
    'password' => '',
);

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