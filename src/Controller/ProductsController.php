<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 13/06/15
 * Time: 13:41
 */

namespace buvette\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use buvette\Domain\Products;
use buvette\Form\Type\ProductType;


class ProductsController {


    /** ========== ACTION =========  */
    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Application $app){

        $products = $this->getProducts($app)->findAllFullStack();

        return $app['twig']->render('products/index.html.twig', array(
            'products' => $products
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
        $productsEM = $this->getProducts($app);
        $productEntity = new Products();

        $productForm = $app['form.factory']->create(new ProductType($app), $productEntity);

        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() && $productForm->isValid()) {

            $productsEM->createEntity($productForm->getData());
            $app['session']->getFlashBag()->add('success', 'The product was successfully created.');

            $productEntity = new Products();
            $productForm = $app['form.factory']->create(new ProductType($app), $productEntity);
        }

        $products = $productsEM->findAllFullStack();
        return $app['twig']->render('products/products.html.twig', array(
            'products' => $products,
            'productForm' => $productForm->createView()
        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     * @param             $productId
     *
     * @return mixed
     */
    public function editAction(Request $request, Application $app, $productId){
        // declare Entity Manager
        $productsEM = $this->getProducts($app);
        $product = $productsEM->findOneById($productId);

        $productForm = $app['form.factory']->create(new ProductType($app), $product);
        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() && $productForm->isValid()) {

            $productsEM->updateEntity($productForm->getData());
            $app['session']->getFlashBag()->add('success', 'The product was successfully created.');
        }

        $products = $productsEM->findAllFullStack();
        return $app['twig']->render('products/products.html.twig', array(
            'products' => $products,
            'productForm' => $productForm->createView()
        ));
    }

    /**
     * @param Application $app
     * @param             $productId
     *
     * @return mixed
     */
    public function deleteAction(Application $app, $productId){

        $productsEM = $this->getProducts($app);
        $product = $productsEM->findOneById($productId);

        if ($product) {

            $productsEM->deleteEntity($product);
            $app['session']->getFlashBag()->add('success', 'The product was successfully Deleted.');

        }

        return $app->redirect('../../products');
    }

    /**
     * @param Application $app
     * @param             $productId
     *
     * @return \Twig_Environment
     */
    public function recetteAction(Application $app, $productId){

        $product = $this->getProducts($app)->findOneById($productId);
        $recipe = $this->getProducts($app)->getRecetteByIdProduct($productId);

        $primProds = $this->getPrimProdsByCategories($app);

        return $app['twig']->render('products/recette.html.twig', array(
            'product'   => $product,
            'recipe'    => $recipe,
            'primProds' => $primProds
        ));
    }

    /** ======== MODEL ======== */

    /**
     * @param Application $app
     *
     * @return array
     */
    private function getPrimProdsByCategories(Application $app){

        $categories = $this->getCatPrimProds($app)->findAll();
        $primProds = array();
        $data = array();
        foreach($categories as $category){

            $products = $this->getPrimProds($app)->find(array('prm_category' => $category->getId()));
            $primProds['title'] = $category->getTitle();
            $primProds['id'] = $category->getId();
            $primProds['count'] = count($products);
            $primProds['product'] = $products;
            $data[] = $primProds;
        }

        return $data;
    }

    /** ======== SERVICE ======== */

    /**
     * @param Application $app
     *
     * @return \buvette\DAO\ProductsZDAO
     */
    private function getProducts(Application $app){

        return $app['zdao.products'];
    }

    /**
     * @param Application $app
     *
     * @return \buvette\DAO\PrimaProductsZDAO
     */
    private function getPrimProds(Application $app){

        return $app['zdao.primaProduct'];
    }

    /**
     * @param Application $app
     *
     * @return \buvette\DAO\CatPrimaProductZDAO
     */
    private function getCatPrimProds(Application $app){

        return $app['zdao.catPrimProds'];
    }

}