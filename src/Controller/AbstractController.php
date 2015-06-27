<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 26/06/15
 * Time: 23:34
 */

namespace buvette\Controller;

use Silex\Application;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\Validator;
use Twig_Environment;

abstract class AbstractController {

    /**
     * @param Application $app
     *
     * @return Form
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




}