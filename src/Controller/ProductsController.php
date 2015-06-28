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
use buvette\Entity\Generated\Products;
use buvette\Form\Type\ProductType;


class ProductsController extends AbstractController {


    /** ========== ACTION =========  */
    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Application $app){

        $products = $this->getProducts($app)->getAllData();

        return $app['twig']->render('products/index.html.twig', array(
            'products' => $products
        ));

    }

    /**
     * @param Request     $request
     * @param Application $app
     * @param null        $productId
     *
     * @return mixed
     */
    public function createAction(Request $request, Application $app, $productId = null){
        // declare Entity Manager
        $productsEM = $this->getProducts($app);
        $productEntity = new Products();
        // if id is send set it
        if($productId){
            $productEntity = $productsEM->findOneById($productId);
        }

        $productForm = $this->getFormFactory($app)->create(new ProductType($app), $productEntity);

        if ($this->formRequestAction($request, $productsEM, $productForm)) {

            $this->getSession($app)->getFlashBag()->add('success', 'The product was successfully created.');

            $productEntity = new Products();
            $productForm =  $this->getFormFactory($app)->create(new ProductType($app), $productEntity);
        }

        $products = $productsEM->getAllData();
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
    public function recipeAction(Application $app, $productId){

        $product = $this->getProducts($app)->findOneById($productId);
        $recipe = $this->getProducts($app)->getRecipeByProductId($productId);

        $primProds = $this->getPrimProdsByCategories($app);

        return $app['twig']->render('products/recipe.html.twig', array(
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

            $products = $this->getPrimProds($app)->find(array('prp_categories_id' => $category->getId()));
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
     * @return \buvette\ZEM\ProductsZEM
     */
    private function getProducts(Application $app){

        return $app['EM']->get('ProductsZEM');
    }

    /**
     * @param Application $app
     *
     * @return \buvette\ZEM\PrimaProductsZEM
     */
    private function getPrimProds(Application $app){

        return $app['EM']->get('PrimProductsZEM');
    }

    /**
     * @param Application $app
     *
     * @return \buvette\ZEM\Generated\CategoriesPrimProductsZEM
     */
    private function getCatPrimProds(Application $app){

        return $app['EM']->get('CategoriesPrimProductsZEM');
    }

}