<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 21/06/15
 * Time: 13:54
 */
namespace buvette\Controller;

use Silex\Application;


class Generator
{

    /**
     * @param Application $app
     *
     * @return bool
     */
    public function indexAction(Application $app)
    {

        $em = $this->getEventEm($app);
        $result = $em->findAll();


        var_dump($result);
        exit;
        return true;
    }

    /**
     * @param $app
     *
     * @return \buvette\ZEM\Generated\EventZEM
     */
    private function getEventEm($app){
        return $app['EM']->get('EventZEM');
    }



}