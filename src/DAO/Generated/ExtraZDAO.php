<?php
/**
 * Data Access Object DAO Extra
 * Auto Generate :2015-06-25 00:37:15
 * extra
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\Extra;

class ExtraZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "extra";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "ext_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return Extra
     */
    protected function buildZEntityObject($row)
    {
        $entity = new Extra();
        $entity->setId($row["ext_id"]);
        $entity->setPrmId($row["ext_prm_id"]);
        $entity->setQuantity($row["ext_quantity"]);
        $entity->setPrice($row["ext_price"]);
        return $entity;
    }

}