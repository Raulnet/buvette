<?php
/**
 * Data Access Object DAO Staff
 * Auto Generate :2015-06-25 00:37:15
 * staff
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\Staff;

class StaffZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "staff";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "stf_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return Staff
     */
    protected function buildZEntityObject($row)
    {
        $entity = new Staff();
        $entity->setId($row["stf_id"]);
        $entity->setName($row["stf_name"]);
        return $entity;
    }

}