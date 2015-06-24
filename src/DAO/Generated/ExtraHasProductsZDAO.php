<?php
/**
 * Data Access Object DAO ExtraHasProducts
 * Auto Generate :2015-06-25 00:37:15
 * extra_has_products
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\ExtraHasProducts;

class ExtraHasProductsZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "extra_has_products";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "ehp_ext_id";

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
     * @return ExtraHasProducts
     */
    protected function buildZEntityObject($row)
    {
        $entity = new ExtraHasProducts();
        $entity->setExtId($row["ehp_ext_id"]);
        $entity->setProId($row["ehp_pro_id"]);
        return $entity;
    }

}