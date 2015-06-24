<?php
/**
 * Data Access Object DAO Products
 * Auto Generate :2015-06-25 00:37:15
 * products
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\Products;

class ProductsZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "products";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "pro_id";

    /**
     * @var string $secondaryKey
     */
    protected $secondaryKey = "pro_cat_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return Products
     */
    protected function buildZEntityObject($row)
    {
        $entity = new Products();
        $entity->setId($row["pro_id"]);
        $entity->setTitle($row["pro_title"]);
        $entity->setCatId($row["pro_cat_id"]);
        return $entity;
    }

}