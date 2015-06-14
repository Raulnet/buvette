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
     * @param $id
     * @return Recette
     */
    public function findOneById($id)
    {
        $select = $this->sql->select();
        $select->where(array('re_pro_id' => $id));
        $row = $this->selectWith($select)->current();

        return $this->buildZDomainObject($row);
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
     * @param Recette $recette
     *
     * @return bool
     */
    public function updateEntity(Recette $recette)
    {
        if ($recette->getProductId()) {
            $where = array('re_pro_id' => $recette->getProductId());
            $this->update($recette->getArray(), $where);
            return true;
        }
        return false;
    }

    /**
     * Delete Player Entity
     *
     * @param Recette $recette
     *
     * @return bool
     */
    public function deleteEntity(Recette $recette)
    {
        if ($recette->getProductId()) {
            $where = array('re_pro_id' => $recette->getProductId());
            $this->delete($where);
            return true;
        }
        return false;
    }

    /**
     * @param $row
     * @return Staff
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