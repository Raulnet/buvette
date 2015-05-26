<?php
/**
 * Created by PhpStorm.
 * User: XVI
 * Date: 29/03/2015
 * Time: 19:47
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

        $staffs = $app['zdao.staff']->findAll();
        $unities = $app['zdao.unities']->findAll();
        $catPrimProds = $app['zdao.catPrimProd']->findAll();
        $DataPrimaProducts = $app['zdao.primaProduct']->findAllData();
        $catProducts = $app['zdao.catProducts']->findAll();
        $products = $app['zdao.products']->getFullSetAll();
        $comboProds = $app['zdao.comboProducts']->getFullSet();
        $events = $app['zdao.events']->findAll();

        return $app['twig']->render('index.html.twig', array(
            'staffs'            => $staffs,
            'unities'           => $unities,
            'catPrimProds'      => $catPrimProds,
            'primaProductsData' => $DataPrimaProducts,
            'catProducts'       => $catProducts,
            'products'          => $products,
            'menus'             => $comboProds,
            'events'            => $events,


        ));
    }


} 