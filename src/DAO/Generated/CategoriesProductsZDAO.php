<?php
/**
 * Data Access Object DAO CategoriesProducts
 * Auto Generate :2015-06-25 00:37:15
 * categories_products
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\CategoriesProducts;

class CategoriesProductsZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "categories_products";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "cat_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return CategoriesProducts
     */
    protected function buildZEntityObject($row)
    {
        $entity = new CategoriesProducts();
        $entity->setId($row["cat_id"]);
        $entity->setTitle($row["cat_title"]);
        return $entity;
    }

}