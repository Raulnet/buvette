<?php
/**
 * Created by PhpStorm.
 * User: XVI
 * Date: 10/04/2015
 * Time: 12:16
 */

$home = $app['controllers_factory'];

/* Route Home */
$home->get('/', "buvette\Controller\HomeController::indexAction")->bind('home');

return $home;

