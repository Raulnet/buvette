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
use buvette\Form\Type\RecipeType;
use buvette\Entity\Generated\Recipe;
use Symfony\Component\Form\Form;


class RecipeController extends AbstractController {

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
        $reponse = $this->requestRecipeFormAction($request, $app, $recipeForm);
        /** ===== END FORM ===== */
        // if form is submit & valid redirect
        if($reponse){
            return $app->redirect($app['url_generator']->generate('recipeProduct', array('productId' => $productId)));
        }
        $primProd = $this->getPrimProds($app)->getAllData($primProdId);

        $recipe = $this->getProducts($app)->getRecipeByProductId($productId);

        return $app['twig']->render('products/recipe.html.twig', array(
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
        $recipeForm = $this->getRecipeForm($app, $primProdId, $productId);
        $reponse = $this->requestRecipeFormAction($request, $app, $recipeForm, true);
        /** ===== END FORM ===== */
        // if form is submit & valid redirect
        if($reponse){
            return $app->redirect($app['url_generator']->generate('recipeProduct', array('productId' => $productId)));
        }

        $primProd = $this->getPrimProds($app)->getAllData($primProdId);

        $recipe = $this->getProducts($app)->getRecipeByProductId($productId);

        return $app['twig']->render('products/recipe.html.twig', array(
            'product'   => $product,
            'primProd'  => $primProd,
            'recipe'    => $recipe,
            'primProds' => $primProds,
            'recipeForm' => $recipeForm->createView()
        ));
    }

    /**
     * @param Application $app
     * @param             $productId
     * @param             $primProdId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removePrimProdToProductAction(Application $app, $productId, $primProdId)
    {
        $recipe = $this->getRecipe($app)->findOneById($primProdId, $productId);
        if($recipe){
            $this->getRecipe($app)->deleteEntity($recipe);
            $app['session']->getFlashBag()->add('success', 'The prima - product successfully removed');
            return $app->redirect($app['url_generator']->generate('recipeProduct', array('productId' => $productId)));
        }
        $app['session']->getFlashBag()->add('warning', 'The prima - product was not removed !!!');
        return $app->redirect($app['url_generator']->generate('recipeProduct', array('productId' => $productId)));

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

        $recipe = $this->getRecipe($app)->findOneById($productId, $primProId);

        if(!$recipe){
            $recipe = new Recipe();
            $recipe->setProductId($productId);
            $recipe->setPrimProductId($primProId);
        }

        $recipeForm = $app['form.factory']->create(new RecipeType(), $recipe);

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

            $products = $this->getPrimProds($app)->find(array('prp_categories_id' => $category->getId()));
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
     *
     * @return bool
     */
    private function requestRecipeFormAction(Request $request, Application $app, Form $recipeForm, $action = false){

        $recipeForm->handleRequest($request);

        if($recipeForm->isSubmitted() && $recipeForm->isValid() && $action === false){
            $this->getRecipe($app)->createEntity($recipeForm->getData());

            $app['session']->getFlashBag()->add('success', 'The product was successfully added.');
            return true;
        }
        if($recipeForm->isSubmitted() && $recipeForm->isValid() && $action === true){

         //   exit(var_dump($recipeForm->getData()));
            $this->getRecipe($app)->updateEntity($recipeForm->getData());

            $app['session']->getFlashBag()->add('success', 'The product was successfully added.');
            return true;
        }
        return false;
    }


    /** ======== SERVICE ======== */
    /**
     * @param Application $app
     *
     * @return \buvette\ZEM\Generated\RecipeZEM
     */
    private function getRecipe(Application $app){

        return $app['EM']->get('RecipeZEM');
    }

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
     * @return \buvette\ZEM\PrimProductsZEM
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