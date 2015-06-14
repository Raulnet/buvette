<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 13/06/15
 * Time: 18:10
 */

namespace buvette\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use buvette\Domain\CategoriesProduct;
use buvette\Form\Type\CategoryProductsType;

class CategoriesProductsController {

    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Application $app){

        $categories = $this->getCatProducts($app)->findAll();

        return $app['twig']->render('catProducts/index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     *
     * @return mixed
     */
    public function addAction(Request $request, Application $app){
        // declare Entity Manager
        $catProdsEM = $this->getCatProducts($app);
        $catProds = new CategoriesProduct();

        $catProdsForm = $app['form.factory']->create(new CategoryProductsType(), $catProds);

        $catProdsForm->handleRequest($request);

        if ($catProdsForm->isSubmitted() && $catProdsForm->isValid()) {

            $catProdsEM->createEntity($catProdsForm->getData());
            $app['session']->getFlashBag()->add('success', 'The event was successfully created.');

            $catProds = new CategoriesProduct();
            $catProdsForm = $app['form.factory']->create(new CategoryProductsType(), $catProds);
        }

        $categories = $catProdsEM->findAll();
        return $app['twig']->render('catProducts/catProds.html.twig', array(
            'categories' => $categories,
            'catProdsForm' => $catProdsForm->createView()
        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     * @param             $catProdsId
     *
     * @return mixed
     */
    public function editAction(Request $request, Application $app, $catProdsId){
        // declare Entity Manager
        $catProdsEM = $this->getCatProducts($app);
        $catProds = $catProdsEM->findOneById($catProdsId);

        $catProdsForm = $app['form.factory']->create(new CategoryProductsType(), $catProds);

        $catProdsForm->handleRequest($request);

        if ($catProdsForm->isSubmitted() && $catProdsForm->isValid()) {

            $catProdsEM->updateEntity($catProdsForm->getData());
            $app['session']->getFlashBag()->add('success', 'The event was successfully created.');

        }

        $categories = $catProdsEM->findAll();
        return $app['twig']->render('catProducts/catProds.html.twig', array(
            'categories' => $categories,
            'catProdsForm' => $catProdsForm->createView()
        ));
    }

    /**
     * @param Application $app
     * @param             $catProdsId
     *
     * @return mixed
     */
    public function deleteAction(Application $app, $catProdsId){

        $catProdsEM = $this->getCatProducts($app);
        $catProds = $catProdsEM->findOneById($catProdsId);

        if ($catProds) {

            $catProdsEM->deleteEntity($catProds);
            $app['session']->getFlashBag()->add('success', 'The category was successfully Deleted.');

        }

        return $app->redirect('../../catProducts');
    }

    /** =========== SERVICE =========== */
    /**
     * @param Application $app
     *
     * @return \buvette\DAO\CatProductZDAO
     */
    private function getCatProducts(Application $app){

        return $app['zdao.catProducts'] ;

    }

}