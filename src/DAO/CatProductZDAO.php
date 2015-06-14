<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 24/05/15
 * Time: 16:25
 */

namespace buvette\DAO;

use buvette\Domain\CategoriesProduct;

class CatProductZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = 'categories_products';

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
     * @return CatProduct
     */
    public function findOneById($id)
    {

        $select = $this->sql->select();
        $select->where(array('cat_id' => $id));
        $row = $this->selectWith($select)->current();

        return $this->buildZDomainObject($row);
    }

    /**
     * @param CategoriesProduct $catProd
     *
     * @return bool
     */
    public function createEntity(CategoriesProduct $catProd)
    {
        if (!$catProd->getId()) {
            $this->insert($catProd->getArray());
            return true;
        }
        return false;
    }

    /**
     * Update Entity
     *
     * @param CategoriesProduct $catProd
     *
     * @return bool
     */
    public function updateEntity(CategoriesProduct $catProd)
    {
        if ($catProd->getId()) {
            $where = array('cat_id' => $catProd->getId());
            $this->update($catProd->getArray(), $where);
            return true;
        }
        return false;
    }

    /**
     * Delete Player Entity
     *
     * @param CategoriesProduct $catProd
     *
     * @return bool
     */
    public function deleteEntity(CategoriesProduct $catProd)
    {
        if ($catProd->getId()) {
            $where = array('cat_id' => $catProd->getId());
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

        $catProd = new CategoriesProduct();
        $catProd->setId($row['cat_id']);
        $catProd->setTitle($row['cat_title']);

        return $catProd;
    }

}