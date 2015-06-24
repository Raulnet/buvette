<?php
/**
 * Data Access Object DAO PrimaProducts
 * Auto Generate :2015-06-25 00:37:15
 * prima_products
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\PrimaProducts;

class PrimaProductsZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "prima_products";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "prm_id";

    /**
     * @var string $secondaryKey
     */
    protected $secondaryKey = "prm_uni_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return PrimaProducts
     */
    protected function buildZEntityObject($row)
    {
        $entity = new PrimaProducts();
        $entity->setId($row["prm_id"]);
        $entity->setTitle($row["prm_title"]);
        $entity->setUniId($row["prm_uni_id"]);
        $entity->setCategory($row["prm_category"]);
        return $entity;
    }

}