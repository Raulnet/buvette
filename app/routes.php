<?php
/**
 * Created by PhpStorm.
 * User: XVI
 * Date: 10/03/15
 * Time: 18:57
 */


// ===== ROUTE GLOBAL =========================================================================================== //

///* Route locale */
//$app->get('/', "buvette\Controller\GlobalController::localeAction");

// ===== ROUTE HOME ============================================================================================= //
$app->mount('/', include 'routes/home_routes.php');

// ===== ROUTE EVENT ============================================================================================ //
$app->mount('/event', include 'routes/event_routes.php');

// ===== ROUTE UNITIES ========================================================================================== //
$app->mount('/unities', include 'routes/unities_routes.php');

// ===== ROUTE CATEGORIES PRIMA PRODUCTS ======================================================================== //
$app->mount('/categorie_prima_product', include 'routes/categories_prima_products_routes.php');

// ===== ROUTE PRIMA PRODUCTS =================================================================================== //
$app->mount('/prima_products', include 'routes/prima_products_routes.php');

// ===== ROUTE PRODUCTS ========================================================================================= //
$app->mount('/products', include 'routes/products_routes.php');

// ===== ROUTE CATEGORIES PRODUCTS ============================================================================== //
$app->mount('/catProducts', include 'routes/categories_products_routes.php');

// ===== ROUTE API ============================================================================================== //

// ===== END ROUTES ============================================================================================= //