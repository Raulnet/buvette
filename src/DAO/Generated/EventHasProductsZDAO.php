<?php
/**
 * Data Access Object DAO EventHasProducts
 * Auto Generate :2015-06-25 00:37:15
 * event_has_products
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\EventHasProducts;

class EventHasProductsZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "event_has_products";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "ehp_evn_id";

    /**
     * @var string $secondaryKey
     */
    protected $secondaryKey = "ehp_pro_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return EventHasProducts
     */
    protected function buildZEntityObject($row)
    {
        $entity = new EventHasProducts();
        $entity->setEvnId($row["ehp_evn_id"]);
        $entity->setProId($row["ehp_pro_id"]);
        $entity->setPrice($row["ehp_price"]);
        return $entity;
    }

}