<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 14/06/15
 * Time: 13:52
 */

namespace buvette\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use buvette\Form\Type\RecetteType;
use buvette\Domain\Recette;
use Symfony\Component\Form\Form;


class recetteController {

    /**
     * @param Request     $request
     * @param Application $app
     * @param             $productId
     * @param             $primProdId
     *
     * @return mixed
     */
    public function addPrimProdToProductAction(Request $request, Application $app, $productId, $primProdId){

        $product = $this->getProducts($app)->findOneById($productId);
        $primProds = $this->getPrimProdsByCategories($app);

        /** ===== FORM =====**/
        $recipeForm = $this->getRecipeForm($app, $productId, $primProdId);
        $recipeForm = $this->requestRecipeFormAction($request, $app, $recipeForm);
        /** ===== END FORM ===== */

        $primProd = $this->getPrimProds($app)->findOneFullStackById($primProdId);

        $recipe = $this->getProducts($app)->getRecetteByIdProduct($productId);

        return $app['twig']->render('products/recette.html.twig', array(
            'product'   => $product,
            'primProd'  => $primProd,
            'recipe'    => $recipe,
            'primProds' => $primProds,
            'recipeForm' => $recipeForm->createView()
        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     * @param             $productId
     * @param             $primProdId
     *
     * @return mixed
     */
    public function editPrimProdToProductAction(Request $request, Application $app, $productId, $primProdId){

        $product = $this->getProducts($app)->findOneById($productId);
        $primProds = $this->getPrimProdsByCategories($app);

        /** ===== FORM =====**/
        $recipeForm = $this->getRecipeForm($app, $productId, $primProdId);
        $recipeForm = $this->requestRecipeFormAction($request, $app, $recipeForm, true);
        /** ===== END FORM ===== */

        $primProd = $this->getPrimProds($app)->findOneFullStackById($primProdId);

        $recipe = $this->getProducts($app)->getRecetteByIdProduct($productId);

        return $app['twig']->render('products/recette.html.twig', array(
            'product'   => $product,
            'primProd'  => $primProd,
            'recipe'    => $recipe,
            'primProds' => $primProds,
            'recipeForm' => $recipeForm->createView()
        ));
    }

    /** ======== METHOD ======== **/

    /**
     * @param Application $app
     * @param             $productId
     * @param             $primProId
     *
     * @return Form
     */
    private function getRecipeForm(Application $app, $productId, $primProId){

        $recipe = $this->getRecette($app)->findOneById($productId, $primProId);

        if(!$recipe){
            $recipe = new Recette();
            $recipe->setProductId($productId);
            $recipe->setPrimProdId($primProId);
        }

        $recipeForm = $app['form.factory']->create(new RecetteType(), $recipe);

        return $recipeForm;
    }

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

    /**
     * @param Request     $request
     * @param Application $app
     * @param Form        $recipeForm
     * @param bool        $action false = create || true = update
     *
     * @return Form
     */
    private function requestRecipeFormAction(Request $request, Application $app, Form $recipeForm, $action = false){

        $recipeForm->handleRequest($request);

        // if action = false create a new entity
        if($recipeForm->isSubmitted() && $recipeForm->isValid() && $action === false){
            $this->getRecette($app)->createEntity($recipeForm->getData());
            $app['session']->getFlashBag()->add('success', 'The product was successfully added.');
        }
        // if action = true update the Entity
        if($recipeForm->isSubmitted() && $recipeForm->isValid() && $action === true){
            $this->getRecette($app)->updateEntity($recipeForm->getData());
            $app['session']->getFlashBag()->add('success', 'The product was successfully updated.');
        }

        return $recipeForm;
    }


    /** ======== SERVICE ======== */
    /**
     * @param Application $app
     *
     * @return \buvette\DAO\RecetteZDAO
     */
    private function getRecette(Application $app){

        return $app['zdao.recette'];
    }

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