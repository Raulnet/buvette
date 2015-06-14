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
        $recipeForm = $this->getRecetteForm($app, $productId, $primProdId);
        $recipeForm->handleRequest($request);
        if($recipeForm->isSubmitted() && $recipeForm->isValid()){
            $this->getRecette($app)->createEntity($recipeForm->getData());
            $app['session']->getFlashBag()->add('success', 'The product was successfully added.');
        }
        /** ===== END FORM ===== */
        $recipe = $this->getProducts($app)->getRecetteByIdProduct($productId);
        return $app['twig']->render('products/recette.html.twig', array(
            'product'   => $product,
            'recipe'    => $recipe,
            'primProds' => $primProds,
            'recipeForm' => $recipeForm->createView()
        ));
    }

    /** ======== MODEL ======== **/

    /**
     * @param Application $app
     * @param             $productId
     * @param             $primProId
     *
     * @return Form
     */
    private function getRecetteForm(Application $app, $productId, $primProId){

        $recette = new Recette();
        $recette->setProductId($productId);
        $recette->setPrimProdId($primProId);

        $recetteForm = $app['form.factory']->create(new RecetteType(), $recette);

        return $recetteForm;
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