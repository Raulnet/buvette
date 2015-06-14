<?php
/**
 * Created by PhpStorm.
 * User: XVI
 * Date: 29/03/2015
 * Time: 19:47
 */

namespace buvette\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use buvette\Form\Type\FormType;


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
        $catPrimProds = $app['zdao.catPrimProds']->findAll();
        $DataPrimaProducts = $app['zdao.primaProduct']->findAllData();
        $catProducts = $app['zdao.catProducts']->findAll();
        $products = $app['zdao.products']->findAllFullStack();
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

    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function formAction(Application $app){

        $form = $app['form.factory']->create(new FormType());

        return $app['twig']->render('form.html.twig', array(
            'form' => $form->createView(),

        ));

    }



    /**
     * Ajax ActionController
     *
     * @return string reponse
     */
    public function ajaxRqAction(Request $request)
    {

        $id = $request->get('id');
        $title = $request->get('title');

        $reponse = array($id, $title);

        return json_encode($reponse);
    }
} 