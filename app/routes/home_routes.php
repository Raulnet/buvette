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

/* Route Form */
$home->get('/form', "buvette\Controller\HomeController::formAction")->bind('form');

/* Ajax Route */
$home->post('/ajaxRq', "buvette\Controller\HomeController::ajaxRqAction" )->bind('ajaxRq');

return $home;

