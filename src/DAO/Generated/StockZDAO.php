<?php
/**
 * Data Access Object DAO Stock
 * Auto Generate :2015-06-25 00:37:15
 * stock
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\Stock;

class StockZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "stock";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "stk_id";

    /**
     * @var string $secondaryKey
     */
    protected $secondaryKey = "stk_prm_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return Stock
     */
    protected function buildZEntityObject($row)
    {
        $entity = new Stock();
        $entity->setId($row["stk_id"]);
        $entity->setPrmId($row["stk_prm_id"]);
        $entity->setQuantity($row["stk_quantity"]);
        $entity->setMovement($row["stk_movement"]);
        $entity->setDatetime($row["stk_datetime"]);
        $entity->setStaffId($row["stk_staff_id"]);
        $entity->setPrice($row["stk_price"]);
        $entity->setEventId($row["stk_event_id"]);
        $entity->setWarning($row["stk_warning"]);
        return $entity;
    }

}