<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 14/06/15
 * Time: 14:23
 */

namespace buvette\DAO;

use buvette\Domain\Recipe;

class RecipeZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = 'recette';

    /**
     * @var string
     */
    protected $foreignKey1 = 're_pro_id';

    /**
     * @var string
     */
    protected $foreignKey2 = 're_prm_id';

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return Recipe
     */
    protected function buildZDomainObject($row)
    {

        $recipe = new Recipe();
        $recipe->setPrimProdId($row['re_prm_id']);
        $recipe->setProductId($row['re_pro_id']);
        $recipe->setQuantity($row['re_prm_quantity']);

        return $recipe;
    }

}