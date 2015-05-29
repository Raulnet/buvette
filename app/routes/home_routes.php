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


/* Ajax Route */
$home->post('/ajaxRq', "buvette\Controller\HomeController::ajaxRqAction" )->bind('ajaxRq');


return $home;

