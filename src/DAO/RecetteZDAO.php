<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 14/06/15
 * Time: 14:23
 */

namespace buvette\DAO;

use buvette\DAO\ZDAO;
use buvette\Domain\Recette;

class RecetteZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = 'recette';

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @return array Entities
     */
    public function findAll()
    {
        $select = $this->sql->select();

        $result = $this->selectWith($select)->toArray();

        $entities = array();
        foreach ($result as $row) {
            $entities[] = $this->buildZDomainObject($row);
        }

        return $entities;
    }

    /**
     * @param $productId
     * @param $prmProdId
     *
     * @return Recette
     */
    public function findOneById($productId, $prmProdId)
    {
        $select = $this->sql->select();
        $select->where(array('re_pro_id' => $productId, 're_prm_id' => $prmProdId ));
        $row = $this->selectWith($select)->current();
        if($row){
            return $this->buildZDomainObject($row);
        }
        return false;
    }

    /**
     * Create a new Entity
     *
     * @param Recette $recette
     *
     * @return bool
     */
    public function createEntity(Recette $recette)
    {

            $this->insert($recette->getArray());
            return true;

    }

    /**
     * Update Entity
     *
     * @param Recette $recipe
     *
     * @return bool
     */
    public function updateEntity(Recette $recipe)
    {
        if ($recipe->getProductId() && $recipe->getPrimProdId()) {
            $where = array('re_pro_id' => $recipe->getProductId(), 're_prm_id' => $recipe->getPrimProdId());
            $this->update($recipe->getArray(), $where);
            return true;
        }
        return false;
    }

    /**
     * Delete Player Entity
     *
     * @param Recette $recipe
     *
     * @return bool
     */
    public function deleteEntity(Recette $recipe)
    {
        if ($recipe->getProductId()) {
            $where = array('re_pro_id' => $recipe->getProductId(), 're_prm_id' => $recipe->getPrimProdId());
            $this->delete($where);
            return true;
        }
        return false;
    }

    /**
     * @param $row
     * @return Recette
     */
    protected function buildZDomainObject($row)
    {

        $recette = new Recette();
        $recette->setPrimProdId($row['re_prm_id']);
        $recette->setProductId($row['re_pro_id']);
        $recette->setQuantity($row['re_prm_quantity']);

        return $recette;
    }

}