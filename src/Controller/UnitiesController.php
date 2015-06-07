<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 09:50
 */

namespace buvette\Controller;

use buvette\DAO\UnitiesZDAO;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use buvette\Domain\Unities;
use buvette\Form\Type\UnityType;


class UnitiesController {

    /**
     * @param Application $app
     *
     * @return mixed
     */
    public function indexAction(Application $app){

        $unities = $app['zdao.unities']->findAll();

        return $app['twig']->render('unities/index.html.twig', array(
            'unities' => $unities
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
        $unity     = new Unities();
        $unityForm = $app['form.factory']->create(new UnityType(), $unity);
        $unityForm->handleRequest($request);
        if ($unityForm->isSubmitted() && $unityForm->isValid()) {
            $app['zdao.unities']->createEntity($unityForm->getData());
            $app['session']->getFlashBag()->add('success', 'The unity was successfully created.');
            /**
             * reset form to new creating
             */
            $unity     = new Unities();
            $unityForm = $app['form.factory']->create(new UnityType(), $unity);
        }
        $unities = $app['zdao.unities']->findAll();

        return $app['twig']->render('unities/addUnities.html.twig', array(
            'unityForm' => $unityForm->createView(),
            'unities'   => $unities,
        ));
    }

    /**
     * @param Application $app
     * @param             $unityId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteUnityAction(Application $app, $unityId) {


        $unity = $app['zdao.unities']->findOneById($unityId);
        if($unity){
            $app['zdao.unities']->deleteEntity($unity);
            $app['session']->getFlashBag()->add('success', 'The unity was succesfully removed.');
        }

        return $app->redirect('/buvette/web/unities/addUnity');

    }


} // END CLASS !!!