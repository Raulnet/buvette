<?php
/**
 * Data Access Object DAO ComboProducts
 * Auto Generate :2015-06-25 00:37:15
 * combo_products
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\ComboProducts;

class ComboProductsZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "combo_products";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "cmb_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return ComboProducts
     */
    protected function buildZEntityObject($row)
    {
        $entity = new ComboProducts();
        $entity->setId($row["cmb_id"]);
        $entity->setTitle($row["cmb_title"]);
        $entity->setPrice($row["cmb_price"]);
        return $entity;
    }

}