<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 20/06/15
 * Time: 16:29
 */
return array(
    "paths" => array(
        "migrations" => __DIR__."/migrations"
    ),
    "environments" => array(
        "default_migration_table" => "phinxlog",
        "default_database" => "buvette",
        "buvette" => array(
            "adapter" => "mysql",
            "host" => '127.0.0.1',
            "name" => 'buvette',
            "user" => 'Raulnet',
            "pass" => '',
            "port" => '3306',
            "chartset" => 'utf8'
        )
    )
);