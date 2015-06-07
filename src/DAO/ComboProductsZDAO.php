<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 24/05/15
 * Time: 19:30
 */
namespace buvette\DAO;

use buvette\Domain\ComboProducts;

class ComboProductsZDAO extends ZDAO
{

    /**
     * @var string table Entity
     */
    protected $table = 'combo_products';

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
     *
     * @return Player
     */
    public function findOneById($id)
    {
        $select = $this->sql->select();
        $select->where(array('cmb_id' => $id));
        $row = $this->selectWith($select)->current();

        return $this->buildZDomainObject($row);
    }

    /**
     * Create a new Entity
     *
     * @param ComboProducts $cmbProd
     *
     * @return bool
     */
    public function createEntity(ComboProducts $cmbProd)
    {
        if (!$cmbProd->getId()) {
            $this->insert($cmbProd->getArray());

            return true;
        }

        return false;
    }

    /**
     * Update Entity
     *
     * @param ComboProducts $cmbProd
     *
     * @return bool
     */
    public function updateEntity(ComboProducts $cmbProd)
    {
        if ($cmbProd->getId()) {
            $where = array('stf_id' => $cmbProd->getId());
            $this->update($cmbProd->getArray(), $where);

            return true;
        }

        return false;
    }

    /**
     * Delete Player Entity
     *
     * @param ComboProducts $cmbProd
     *
     * @return bool
     */
    public function deleteEntity(ComboProducts $cmbProd)
    {
        if ($cmbProd->getId()) {
            $where = array('cmb_id' => $cmbProd->getId());
            $this->delete($where);

            return true;
        }

        return false;
    }

    /**
     * @return null
     */
    public function getFullSet()
    {
        $select = $this->sql->select();
        $results = $this->selectWith($select)->toArray();

        $menus = array();
        foreach($results as $combo){

            $combo['compo'] = $this->getProductsByCombo($combo['cmb_id']);

            $menus[] = $combo;
        }

        return $menus;
    }

    public function getProductsByCombo($id)
    {
        $select = $this->sql->select();
        $select->columns(array('id' => 'cmb_id'));
        $select->join(array('prc' => 'products_has_combo'), 'prc.combo_products_cmb_id = cmb_id', array('quantity' => 'quantity_prod'), $select::JOIN_LEFT);
        $select->join(array('pro' => 'products'), 'pro.pro_id = prc.products_pro_id', array('pro_title'), $select::JOIN_LEFT);
        $select->where('cmb_id = ' . $id);
        $results = $this->selectWith($select)->toArray();

        return$results;

    }

    /**
     * @param $row
     *
     * @return ComboProducts
     */
    protected function buildZDomainObject($row)
    {
        $cmbProd = new ComboProducts();
        $cmbProd->setId($row['cmb_id']);
        $cmbProd->setTitle($row['cmb_title']);
        $cmbProd->setPrice($row['cmb_price']);

        return $cmbProd;
    }

} //END CLASS !!!