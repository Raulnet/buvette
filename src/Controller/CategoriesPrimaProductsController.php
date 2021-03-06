<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 11:47
 */

namespace buvette\Controller;

use Silex\Application;
use buvette\Entity\Generated\CategoriesPrimProducts;
use buvette\Form\Type\CatPrimProdsType;
use Symfony\Component\HttpFoundation\Request;

class CategoriesPrimaProductsController extends AbstractController {

    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Application $app){

        $catPrimProds = $this->getCatPrimProducts($app)->findAll();

        return $this->getTwig($app)->render('catPrimProds/index.html.twig', array(
            'catPrimProds' => $catPrimProds
        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     *
     * @return mixed
     */
    public function addAction(Request $request, Application $app)
    {
        $catPrimProds     = new CategoriesPrimProducts();
        $categoryForm = $this->getFormFactory($app)->create(new CatPrimProdsType(), $catPrimProds);

        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            if( $this->getCatPrimProducts($app)->createEntity($categoryForm->getData())) {
                $app['session']->getFlashBag()->add('success', 'The new Primary Products category was successfully created.');
            }
             // reset form to new creating
            $catPrimProds     = new CategoriesPrimProducts();
            $categoryForm = $this->getFormFactory($app)->create(new CatPrimProdsType(), $catPrimProds);
        }
        $catPrimProds = $this->getCatPrimProducts($app)->findAll();

        return $app['twig']->render('catPrimProds/addCategory.html.twig', array(
            'categoryForm' => $categoryForm->createView(),
            'catPrimProds'   => $catPrimProds,
        ));
    }

    /**
     * @param Request     $request
     * @param Application $app
     * @param             $categoryId
     *
     * @return mixed
     */
    public function editAction(Request $request, Application $app, $categoryId)
    {
        //find entity will be edited
        $catPrimProds     = $this->getCatPrimProducts($app)->findOneById($categoryId);

        $categoryForm = $this->getFormFactory($app)->create(new CatPrimProdsType(), $catPrimProds);

        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            if( $this->getCatPrimProducts($app)->updateEntity($categoryForm->getData())) {
                $app['session']->getFlashBag()->add('success', 'The Primary Products category was successfully updated.');
            }
        }

        $catPrimProds = $this->getCatPrimProducts($app)->findAll();

        return $app['twig']->render('catPrimProds/addCategory.html.twig', array(
            'categoryForm' => $categoryForm->createView(),
            'catPrimProds'   => $catPrimProds,
        ));
    }

    /**
     * @param Application $app
     * @param             $categoryId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteCategoryAction(Application $app, $categoryId) {

        if($this->getCatPrimProducts($app)->deleteEntity($categoryId)){
            $app['session']->getFlashBag()->add('success', 'The category was succesfully removed.');
        } else {
            $app['session']->getFlashBag()->add('danger', 'The category can\'t removed.');
        }
        return $app->redirect('/buvette/web/categorie_prima_product/addCategory');
    }


    /** ========= SERVICE ========== **/
    /**
     * @param $app
     *
     * @return \buvette\ZEM\Generated\CategoriesPrimProductsZEM
     */
    public function getCatPrimProducts($app){

        return $app['EM']->get('CategoriesPrimProductsZEM');
    }




}