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
     * @var string
     */
    protected $primaryKey = 'cmb_id';

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
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

}