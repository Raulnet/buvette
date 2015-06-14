<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 13/06/15
 * Time: 13:48
 */

$products = $app['controllers_factory'];

/* Route index Event */
$products->get('/', "buvette\Controller\ProductsController::indexAction")->bind('products');
/* Route add Product */
$products->match('/addCatProds', "buvette\Controller\ProductsController::addAction")->bind('addProduct');
/* Route edit Product */
$products->match('/edit/{productId}', "buvette\Controller\ProductsController::editAction")->bind('editProduct');
/* Route Delete Product */
$products->get('/delete/{productId}', "buvette\Controller\ProductsController::deleteAction")->bind('deleteProduct');

/* ========== RECETTE =========== */

/* Route Recette Product */
$products->match('/recette/{productId}', "buvette\Controller\ProductsController::recetteAction")->bind('recetteProduct');

/* Route Recette Product */
$products->match('/recette/add/{productId}/{primProdId}', "buvette\Controller\RecetteController::addPrimProdToProductAction")->bind('addPrimProdToProduct');



return $products;