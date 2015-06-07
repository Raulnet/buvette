<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 11:55
 */

$catPrimProd = $app['controllers_factory'];

/* Route index Event */
$catPrimProd->get('/', "buvette\Controller\CategoriesPrimaProductsController::indexAction")->bind('catPrimProds');
/* Route add Event */
$catPrimProd->match('/addCategory', "buvette\Controller\CategoriesPrimaProductsController::addAction")->bind('addCatPrimProds');
/* Route Delete Event */
$catPrimProd->get('/deleteCategory/{categoryId}', "buvette\Controller\CategoriesPrimaProductsController::deleteCategoryAction")->bind('deleteCatPrimProds');


/**
 * @return mount event
 */
return $catPrimProd;
