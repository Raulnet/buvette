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

      var_dump($this->getEventEm($app));exit;
        $result = $em->findOneById(13);
        var_dump($result);
echo'ok';

      exit;
        return true;
    }

    /**
     * @param $app
     *
     * @return \buvette\DAO\Generated\EventZDAO
     */
    private function getEventEm($app){
        return $app['EM']->get('EventZDAO');
    }



}