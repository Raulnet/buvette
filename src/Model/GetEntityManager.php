<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 24/06/15
 * Time: 23:59
 */

namespace buvette\Model;

class GetEntityManager {

    private $rootDao = '\buvette\DAO\\';

    private $rootDaoGenerated = '\buvette\DAO\Generated\\';

    private $configArray = array();

    function __construct($configArray)
    {
        $this->configArray = $configArray;
    }

    /**
     * @param $entityManager
     *
     * @return string
     */
    public function get($entityManager){

        if(class_exists($this->rootDao.$entityManager)){

            $obj = $this->rootDao.$entityManager;

            return new $obj($this->configArray);
        }

        if(class_exists($this->rootDaoGenerated.$entityManager)){

            $obj = $this->rootDaoGenerated.$entityManager;

            return new $obj($this->configArray);
        }

        return $this->rootDao.$entityManager;
    }

}