<?php
/**
 * Data Access Object DAO Unities
 * Auto Generate :2015-06-25 00:37:15
 * unities
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\Unities;

class UnitiesZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "unities";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "uni_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return Unities
     */
    protected function buildZEntityObject($row)
    {
        $entity = new Unities();
        $entity->setId($row["uni_id"]);
        $entity->setTitle($row["uni_title"]);
        return $entity;
    }

}