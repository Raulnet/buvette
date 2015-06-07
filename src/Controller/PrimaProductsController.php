<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 14:15
 */

namespace buvette\Controller;

use buvette\Form\Type\PrimProdType;
use buvette\Domain\PrimaProducts;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class PrimaProductsController {

    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Application $app) {

        $primProds = $app['zdao.primaProduct']->findAllData();

        return $app['twig']->render('primProds/index.html.twig', array(
            'primProds'            => $primProds,

        ));
    }

    public function addAction(Request $request, Application $app) {

        $primProd = new PrimaProducts();
        $primProdForm = $app['form.factory']->create(new PrimProdType($app), $primProd);

        $primProdForm->handleRequest($request);
        if ($primProdForm->isSubmitted() && $primProdForm->isValid()) {

            $app['zdao.primaProduct']->createEntity($primProdForm->getData());
            $app['session']->getFlashBag()->add('success', 'The prima product was successfully created.');

            /**
             * reset form to new creating
             */
            $primProd = new PrimaProducts();
            $primProdForm = $app['form.factory']->create(new PrimProdType($app), $primProd);
        }

        $primProds = $app['zdao.primaProduct']->findAllData();

        return $app['twig']->render('primProds/add.html.twig', array(
            'primProdForm'  => $primProdForm->createView(),
            'primProds'     => $primProds,
        ));
    }

    /**
     * @param Application $app
     * @param             $primProdId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Application $app, $primProdId) {


        $primProd = $app['zdao.primaProduct']->findOneById($primProdId);
        if($primProd){
            $app['zdao.primaProduct']->deleteEntity($primProd);
            $app['session']->getFlashBag()->add('success', 'The prima products was succesfully removed.');
        }

        return $app->redirect('/buvette/web/prima_products/addPrimProds');

    }




} // END CLASS !!!!