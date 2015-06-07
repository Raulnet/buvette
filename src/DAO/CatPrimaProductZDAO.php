<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 24/05/15
 * Time: 12:53
 */

namespace buvette\DAO;

use buvette\Domain\CategoriesPrimaProduct;

class CatPrimaProductZDAO extends ZDAO{


    /**
     * @var string table Entity
     */
    protected $table = 'categories_prima_products';

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
     * @return Category Prim Products
     */
    public function findOneById($id)
    {

        $select = $this->sql->select();
        $select->where(array('cpp_id' => $id));
        $row = $this->selectWith($select)->current();

        return $this->buildZDomainObject($row);
    }

    /**
     * Create a new Entity
     *
     * @param CategoriesPrimaProduct $catPrimProd
     *
     * @return bool
     */
    public function createEntity(CategoriesPrimaProduct $catPrimProd)
    {
        if (!$catPrimProd->getId()) {
            $this->insert($catPrimProd->getArray());
            return true;
        }
        return false;
    }

    /**
     * Update Entity
     *
     * @param CategoriesPrimaProduct $catPrimProd
     * @return bool
     */
    public function updateEntity(CategoriesPrimaProduct $catPrimProd)
    {
        if ($catPrimProd->getId()) {
            $where = array('cpp_id' => $catPrimProd->getId());
            $this->update($catPrimProd->getArray(), $where);
            return true;
        }
        return false;
    }

    /**
     * Delete Unities Entity
     *
     * @param CategoriesPrimaProducts $catPrimProd
     * @return bool
     */
    public function deleteEntity(CategoriesPrimaProduct $catPrimProd)
    {
        if ($catPrimProd->getId()) {
            $where = array('cpp_id' => $catPrimProd->getId());
            $this->delete($where);
            return true;
        }
        return false;
    }

    /**
     * @param $row
     * @return Unities
     */
    protected function buildZDomainObject($row)
    {

        $catPrimProd = new CategoriesPrimaProduct();
        $catPrimProd->setId($row['cpp_id']);
        $catPrimProd->setTitle($row['cpp_title']);

        return $catPrimProd;
    }





} // END CLASS !!!