<?php
/**
 * Data Access Object DAO Phinxlog
 * Auto Generate :2015-06-25 00:37:15
 * phinxlog
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\Phinxlog;

class PhinxlogZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "phinxlog";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return Phinxlog
     */
    protected function buildZEntityObject($row)
    {
        $entity = new Phinxlog();
        $entity->setVersion($row["version"]);
        $entity->setStartTime($row["start_time"]);
        $entity->setTime($row["end_time"]);
        return $entity;
    }

}