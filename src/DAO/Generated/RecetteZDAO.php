<?php
/**
 * Data Access Object DAO Recette
 * Auto Generate :2015-06-25 00:37:15
 * recette
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\Recette;

class RecetteZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "recette";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "re_prm_id";

    /**
     * @var string $secondaryKey
     */
    protected $secondaryKey = "re_pro_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return Recette
     */
    protected function buildZEntityObject($row)
    {
        $entity = new Recette();
        $entity->setPrmId($row["re_prm_id"]);
        $entity->setProId($row["re_pro_id"]);
        $entity->setPrmQuantity($row["re_prm_quantity"]);
        return $entity;
    }

}