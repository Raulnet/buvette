<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 26/06/15
 * Time: 23:34
 */

namespace buvette\Controller;

use buvette\ZEM\Generated\ZEM;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\Validator;
use Twig_Environment;
use Symfony\Component\HttpFoundation\Session\Session;

abstract class AbstractController {

    /**
     * @param Application $app
     *
     * @return FormFactory
     */
    protected function getFormFactory(Application $app){

        return $app['form.factory'];
    }

    /**
     * @param Application $app
     *
     * @return Validator
     */
    protected function getValidator(Application $app) {

        return $app['validator'];
    }

    /**
     * @param Application $app
     *
     * @return Twig_Environment
     */
    protected function getTwig(Application $app){

        return $app['twig'];
    }

    /**
     * @param Application $app
     *
     * @return Session
     */
    protected function getSession(Application $app){

        return $app['session'];
    }

    /** ========== EM ========== **/

    /**
     * @param ZEM    $em
     * @param Entity $entity
     *
     * @return bool
     */
    protected function addEntity(ZEM $em, Entity $entity){

        if($em->createEntity($entity)){
            return true;
        }
        return false;
    }

    /**
     * @param ZEM    $em
     * @param Entity $entity
     *
     * @return bool
     */
    protected function updateEntity(ZEM $em, Entity $entity){

        if($em->updateEntity($entity)){
            return true;
        }
        return false;
    }

    /**
     * @param ZEM    $em
     * @param Entity $entity | int entityId
     *
     * @return bool
     */
    protected function deleteEntity(ZEM $em, $entity){

        if($em->deleteEntity($entity)){
            return true;
        }
        return false;
    }

    /**
     * @param Request $request
     * @param Form    $form
     * @param ZEM     $em
     *
     * @return bool
     */
    protected function formRequestAction(Request $request, ZEM $em, Form $form){

        $form->handleRequest($request);
        if ( $form->isSubmitted() &&  $form->isValid()) {
            if($em->saveEntity($form->getData())){
                return true;
            }
        }
        return false;
    }




}