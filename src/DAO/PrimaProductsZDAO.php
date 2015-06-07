<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 24/05/15
 * Time: 14:34
 */

namespace buvette\DAO;

use buvette\Domain\PrimaProducts;

class PrimaProductsZDAO extends ZDAO{

    /**
     * @var string table Entity
     */
    protected $table = 'prima_products';

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
     * @return PrimaProducts
     */
    public function findOneById($id)
    {

        $select = $this->sql->select();
        $select->where(array('prm_id' => $id));
        $row = $this->selectWith($select)->current();

        return $this->buildZDomainObject($row);
    }

    /**
     * Create a new Entity
     *
     * @param PrimaProducts $primProd
     *
     * @return bool
     */
    public function createEntity(PrimaProducts $primProd)
    {
        if (!$primProd->getId()) {
            $this->insert($primProd->getArray());
            return true;
        }
        return false;
    }

    /**
     * Update Entity
     *
     * @param PrimaProducts $primProd
     *
     * @return bool
     */
    public function updateEntity(PrimaProducts $primProd)
    {
        if ($primProd->getId()) {
            $where = array('prm_id' => $primProd->getId());
            $this->update($primProd->getArray(), $where);
            return true;
        }
        return false;
    }

    /**
     * Delete Player Entity
     *
     * @param PrimaProducts $primProd
     *
     * @return bool
     */
    public function deleteEntity(PrimaProducts $primProd)
    {
        if ($primProd->getId()) {
            $where = array('prm_id' => $primProd->getId());
            $this->delete($where);
            return true;
        }
        return false;
    }

    /**
     * @param $row
     * @return PrimaProducts
     */
    protected function buildZDomainObject($row)
    {

        $primProd = new PrimaProducts();
        $primProd->setId($row['prm_id']);
        $primProd->setTitle($row['prm_title']);
        $primProd->setCategoryId($row['prm_category']);
        $primProd->setUnityId($row['prm_category']);

        return $primProd;
    }

    public function findAllData() {

        $select = $this->sql->select();
        $select->columns(array(
            'id' => 'prm_id',
            'title' => 'prm_title'
        ));
        $select->join(array('cpp' => 'categories_prima_products'), 'cpp.cpp_id = prima_products.prm_category', array('catTitle' => 'cpp_title'), $select::JOIN_LEFT );
        $select->join(array('uni' => 'unities'), 'uni.uni_id = prima_products.prm_uni_id', array('uniTitle' => 'uni_title'), $select::JOIN_LEFT );

        $result = $this->selectWith($select)->toArray();


        return $result;


    }

}