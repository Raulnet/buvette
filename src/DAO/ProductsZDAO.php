<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 24/05/15
 * Time: 16:55
 */
namespace buvette\DAO;

use buvette\Domain\Products;

class ProductsZDAO extends ZDAO
{

    /**
     * @var string table Entity
     */
    protected $table = 'products';

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
     * @return CatProduct
     */
    public function findOneById($id)
    {
        $select = $this->sql->select();
        $select->where(array('pro_id' => $id));
        $row = $this->selectWith($select)->current();

        return $this->buildZDomainObject($row);
    }

    /**
     * Create a new Entity
     *
     * @param Products $prod
     *
     * @return bool
     */
    public function createEntity(Products $prod)
    {
        if (!$prod->getId()) {
            $this->insert($prod->getArray());

            return true;
        }

        return false;
    }

    /**
     * Update Entity
     *
     * @param Products $prod
     *
     * @return bool
     */
    public function updateEntity(Products $prod)
    {
        if ($prod->getId()) {
            $where = array('pro_id' => $prod->getId());
            $this->update($prod->getArray(), $where);

            return true;
        }

        return false;
    }

    /**
     * Delete Product Entity
     *
     * @param Products $prod
     *
     * @return bool
     */
    public function deleteEntity(Products $prod)
    {
        if ($prod->getId()) {
            $where = array('pro_id' => $prod->getId());
            $this->delete($where);

            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function findAllFullStack()
    {
        $select = $this->sql->select();
        $select->columns(array(
            'id'    => 'pro_id',
            'title' => 'pro_title',
        ));
        $select->join(array('cat' => 'categories_products'), 'cat.cat_id = pro_cat_id', array('catTitle' => 'cat_title'));
        $select->order('pro_cat_id');
        $products = $this->selectWith($select)->toArray();

        $results = array();
        foreach($products as $product){
            $compo = $this->getRecetteByIdProduct($product['id']);
            $product['recette'] = $compo;
            $optionCompo = $this->getOptionRecetteByIdProduct($product['id']);

            $product['option_recette'] = $optionCompo;

            $results[] =$product;
        }
        return $results;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getRecetteByIdProduct($id)
    {
        $select = $this->sql->select();
        $select->columns(array('id' => 'pro_id'));
        $select->join(array('re' => 'recette'), 're.re_pro_id =pro_id', array('quantity' => 're_prm_quantity'), $select::JOIN_LEFT);
        $select->join(array('prm' => 'prima_products'), 'prm.prm_id = re.re_prm_id', array('prm_id' => 'prm_id', 'prmTitle' => 'prm_title'), $select::JOIN_LEFT);
        $select->join(array('uni' => 'unities'), 'uni.uni_id = prm_uni_id', array('uniTitle' => 'uni_title'), $select::JOIN_LEFT);
        $select->join(array('cpp' => 'categories_prima_products'), 'cpp.cpp_id = prm.prm_category', array('cppTitle' => 'cpp_title'), $select::JOIN_LEFT);

        $select->where(array('pro_id ='. $id));
        $result = $this->selectWith($select)->toArray();

        return $result;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getOptionRecetteByIdProduct($id){

        $select = $this->sql->select();
        $select->columns(array('id' => 'pro_id'));
        $select->join(array('ro' => 'option_recette'), 'ro.ore_pro_id = pro_id', array('quantity' => 'ore_prm_quantity'), $select::JOIN_LEFT);
        $select->join(array('prm' => 'prima_products'), 'prm.prm_id = ore_prm_id', array('prmTitle' => 'prm_title'), $select::JOIN_LEFT);
        $select->join(array('uni' => 'unities'), 'uni.uni_id = prm_uni_id', array('uniTitle' => 'uni_title'), $select::JOIN_LEFT);
        $select->join(array('cpp' => 'categories_prima_products'), 'cpp.cpp_id = prm.prm_category', array('cppTitle' => 'cpp_title'), $select::JOIN_LEFT);

        $select->where(array('pro_id ='. $id));
        $result = $this->selectWith($select)->toArray();

        return $result;
    }

    /**
     * @param $row
     *
     * @return Product
     */
    protected function buildZDomainObject($row)
    {
        $prod = new Products();
        $prod->setId($row['pro_id']);
        $prod->setTitle($row['pro_title']);
        $prod->setCategoryId($row['pro_cat_id']);

        return $prod;
    }


}