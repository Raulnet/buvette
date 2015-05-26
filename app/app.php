<?php
/**
 * Created by PhpStorm.
 * User: XVI
 * Date: 10/03/15
 * Time: 18:56
 */

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    return $twig;
}));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());


/* Register services */

/****** EM Staffs ******/
$app['zdao.staff'] = $app->share(function ($app) {
    return new buvette\DAO\StaffZDAO($app['zdb.configArray']);
});
/***** EM Unities *****/
$app['zdao.unities'] = $app->share(function ($app) {
    return new buvette\DAO\UnitiesZDAO($app['zdb.configArray']);
});
/***** EM Categories Prima Products ******/
$app['zdao.catPrimProd'] = $app->share(function ($app) {
    return new buvette\DAO\CatPrimaProductZDAO($app['zdb.configArray']);
});
/****** EM PRIMA PRODUCTS ******/
$app['zdao.primaProduct'] = $app->share(function ($app) {
    return new buvette\DAO\PrimaProductsZDAO($app['zdb.configArray']);
});
/****** EM CATEGORIES PRODUCTS ******/
$app['zdao.catProducts'] = $app->share(function ($app) {
    return new buvette\DAO\CatProductZDAO($app['zdb.configArray']);
});
/****** EM PRODUCTS ******/
$app['zdao.products'] = $app->share(function ($app) {
    return new buvette\DAO\ProductsZDAO($app['zdb.configArray']);
});
/****** EM COMBO PRODUCTS ******/
$app['zdao.comboProducts'] = $app->share(function ($app) {
    return new buvette\DAO\ComboProductsZDAO($app['zdb.configArray']);
});
/****** EM EVENTS ******/
$app['zdao.events'] = $app->share(function ($app) {
    return new buvette\DAO\EventsZDAO($app['zdb.configArray']);
});





// Register error handler
//$app->error(function (\Exception $e, $code) use ($app) {
//    switch ($code) {
//        case 403:
//            $message = 'Access denied.';
//            break;
//        case 404:
//            $message = 'The requested resource could not be found.';
//            break;
//        default:
//            $message = "Something went wrong.";
//    }
//    return $app['twig']->render('error.html.twig', array('message' => $message));
//});
