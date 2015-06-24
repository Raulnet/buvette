<?php
/**
 * Data Access Object DAO ProductsHasCombo
 * Auto Generate :2015-06-25 00:37:15
 * products_has_combo
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\ProductsHasCombo;

class ProductsHasComboZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "products_has_combo";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "phc_pro_id";

    /**
     * @var string $secondaryKey
     */
    protected $secondaryKey = "phc_cmb_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return ProductsHasCombo
     */
    protected function buildZEntityObject($row)
    {
        $entity = new ProductsHasCombo();
        $entity->setProId($row["phc_pro_id"]);
        $entity->setCmbId($row["phc_cmb_id"]);
        $entity->setQuantity($row["phc_quantity"]);
        return $entity;
    }

}