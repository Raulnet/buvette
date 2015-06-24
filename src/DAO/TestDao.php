<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 23/06/15
 * Time: 22:31
 */

namespace buvette\DAO;

use buvette\DAO\Generated\EventZDAO as EventZDAOLegacy;

class TestDao extends EventZDAOLegacy {

    public function getAll(){

        return $this->findAll();
    }


}