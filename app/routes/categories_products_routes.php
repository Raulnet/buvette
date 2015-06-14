<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 13/06/15
 * Time: 18:28
 */

$catProds = $app['controllers_factory'];

/* Route index Event */
$catProds->get('/', "buvette\Controller\CategoriesProductsController::indexAction")->bind('catProds');
/* Route add CatProduct */
$catProds->match('/addCatProds', "buvette\Controller\CategoriesProductsController::addAction")->bind('addCatProds');
/* Route edit CatProduct */
$catProds->match('/edit/{catProdsId}', "buvette\Controller\CategoriesProductsController::editAction")->bind('editCatProds');
/* Route Delete CatProduct */
$catProds->get('/delete/{catProdsId}', "buvette\Controller\CategoriesProductsController::deleteAction")->bind('deleteCatProds');

/**
 * @return mount event
 */
return $catProds;