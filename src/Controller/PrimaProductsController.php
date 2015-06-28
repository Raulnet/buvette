<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 14:15
 */

namespace buvette\Controller;

use buvette\Form\Type\PrimProdType;
use buvette\Entity\Generated\PrimProducts;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class PrimaProductsController extends AbstractController {

    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Application $app) {

        $primProds = $this->getPrimProduct($app)->getAllData();

        return $this->getTwig($app)->render('primProds/index.html.twig', array(
            'primProds'            => $primProds,

        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     *
     * @return mixed
     */
    public function addAction(Request $request, Application $app) {

        $primProd = new PrimProducts();
        $em = $this->getPrimProduct($app);

        $primProdForm = $this->getFormFactory($app)->create(new PrimProdType($app), $primProd);

        if($this->formRequestAction($request, $em, $primProdForm))
        {
            $this->getSession($app)->getFlashBag()->add('success', 'The prima product was successfully created.');
        }

        $primProds = $em->getAllData();

        return $app['twig']->render('primProds/add.html.twig', array(
            'primProdForm'  => $primProdForm->createView(),
            'primProds'     => $primProds,
        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     * @param             $primProdId
     *
     * @return mixed
     */
    public function editAction(Request $request, Application $app, $primProdId)
    {

        $em = $this->getPrimProduct($app);
        $primProd = $em->findOneById($primProdId);

        $primProdForm = $this->getFormFactory($app)->create(new PrimProdType($app), $primProd);

        if($this->formRequestAction($request, $em, $primProdForm))
        {
            $this->getSession($app)->getFlashBag()->add('success', 'The prima product was successfully created.');
        }

        $primProds = $em->getAllData();

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


        $primProd = $this->getPrimProduct($app)->findOneById($primProdId);
        if($primProd){
            $this->getPrimProduct($app)->deleteEntity($primProd);
            $app['session']->getFlashBag()->add('success', 'The prima products '. $primProd->getTitle().' was succesfully removed.');
        }

        return $app->redirect('/buvette/web/prima_products/addPrimProds');

    }


/** ========== SERVICE ========= **/
    /**
     * @param Application $app
     *
     * @return \buvette\ZEM\PrimProductsZEM
     */
    private function getPrimProduct(Application $app){
        return $app['EM']->get('PrimProductsZEM');
    }

}