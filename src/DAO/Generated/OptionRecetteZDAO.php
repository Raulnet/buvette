<?php
/**
 * Data Access Object DAO OptionRecette
 * Auto Generate :2015-06-25 00:37:15
 * option_recette
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\OptionRecette;

class OptionRecetteZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "option_recette";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "ore_prm_id";

    /**
     * @var string $secondaryKey
     */
    protected $secondaryKey = "ore_pro_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return OptionRecette
     */
    protected function buildZEntityObject($row)
    {
        $entity = new OptionRecette();
        $entity->setPrmId($row["ore_prm_id"]);
        $entity->setProId($row["ore_pro_id"]);
        $entity->setPrmQuantity($row["ore_prm_quantity"]);
        return $entity;
    }

}