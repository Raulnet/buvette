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
     * @var string
     */
    protected $primaryKey = 'prm_id';

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
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

    /**
     * @return array
     */
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

    /**
     * @param $id
     *
     * @return mixed
     */
    public function findOneFullStackById($id){
        $select = $this->sql->select();
        $select->columns(array('id' => 'prm_id',
                               'title' => 'prm_title'))
            ->join(array('cpp' => 'categories_prima_products'), 'cpp.cpp_id = prima_products.prm_category', array('catTitle' => 'cpp_title'), $select::JOIN_LEFT )
            ->join(array('uni' => 'unities'), 'uni.uni_id = prima_products.prm_uni_id', array('uniTitle' => 'uni_title'), $select::JOIN_LEFT )
            ->where(array('prm_id' => $id));

        return $this->selectWith($select)->current();
    }



}