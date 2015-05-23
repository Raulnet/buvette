<?php
/**
 * Created by PhpStorm.
 * User: XVI
 * Date: 09/03/15
 * Time: 20:05
 */

namespace buvette\Controller;


use Silex\Application;


class HomeController
{

    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app)
    {
        return $app['twig']->render('index.html.twig', array());
    }


}