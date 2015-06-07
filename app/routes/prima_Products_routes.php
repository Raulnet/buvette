<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 14:10
 */

$primProds = $app['controllers_factory'];

/* Route index Event */
$primProds->get('/', "buvette\Controller\PrimaProductsController::indexAction")->bind('primProds');
/* Route add Event */
$primProds->match('/addPrimProds', "buvette\Controller\PrimaProductsController::addAction")->bind('addPrimProd');
/* Route Delete Event */
$primProds->get('/deletePrimProd/{primProdId}', "buvette\Controller\PrimaProductsController::deleteAction")->bind('deletePrimProd');

/**
 * @return mount event
 */
return $primProds;