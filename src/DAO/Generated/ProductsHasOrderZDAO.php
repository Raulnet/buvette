<?php
/**
 * Data Access Object DAO ProductsHasOrder
 * Auto Generate :2015-06-25 00:37:15
 * products_has_order
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\ProductsHasOrder;

class ProductsHasOrderZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "products_has_order";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "pro_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return ProductsHasOrder
     */
    protected function buildZEntityObject($row)
    {
        $entity = new ProductsHasOrder();
        $entity->setId($row["pro_id"]);
        $entity->setId($row["ord_id"]);
        $entity->setProQuantity($row["ord_pro_quantity"]);
        $entity->setId($row["cmb_id"]);
        return $entity;
    }

}