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
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\Validator;
use Twig_Environment;

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
     * @param Form $form
     *
     * @return bool
     */
    protected function formRequestAction(Form $form){

        if ( $form->isSubmitted() &&  $form->isValid()) {
            return true;
        }
        return false;
    }




}