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
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('fr'),
));


/* Register services */
$app['EM'] = $app->share(function ($app) {
    return new \buvette\Model\GetEntityManager($app['zdb.configArray'], $app);
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
