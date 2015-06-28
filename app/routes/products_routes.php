<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 13/06/15
 * Time: 13:48
 */

use Silex\Route;

$products = $app['controllers_factory'];

/* Route index Event */
$products->get('/', "buvette\Controller\ProductsController::indexAction")->bind('products');
/* Route add Product */
$products->match('/createProduct/{productId}', "buvette\Controller\ProductsController::createAction")->value('productId', null)
    ->bind('createProduct');
/* Route Delete Product */
$products->get('/delete/{productId}', "buvette\Controller\ProductsController::deleteAction")->bind('deleteProduct');

/* ========== RECETTE =========== */

/* Route Recipe Product */
$products->match('/recipe/{productId}', "buvette\Controller\ProductsController::recipeAction")->bind('recipeProduct');

/* Route Recipe addPrimProduct */
$products->match('/recipe/add/{productId}/{primProdId}', "buvette\Controller\RecipeController::addPrimProdToProductAction")->bind('addPrimProdToProduct');
/* Route Recipe editPrimProduct */
$products->match('/recipe/edit/{productId}/{primProdId}', "buvette\Controller\RecipeController::editPrimProdToProductAction")->bind('editPrimProdToProduct');
/* Route Recipe removeProduct */
$products->get('/recipe/remove/{productId}/{primProdId}', "buvette\Controller\RecipeController::removePrimProdToProductAction")->bind('removePrimProdToProduct');



return $products;