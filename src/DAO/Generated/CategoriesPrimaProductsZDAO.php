<?php
/**
 * Data Access Object DAO CategoriesPrimaProducts
 * Auto Generate :2015-06-25 00:37:15
 * categories_prima_products
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\CategoriesPrimaProducts;

class CategoriesPrimaProductsZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "categories_prima_products";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "cpp_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return CategoriesPrimaProducts
     */
    protected function buildZEntityObject($row)
    {
        $entity = new CategoriesPrimaProducts();
        $entity->setId($row["cpp_id"]);
        $entity->setTitle($row["cpp_title"]);
        return $entity;
    }

}