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
     * @var string
     */
    protected $primaryKey = 'pro_id';

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
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
            $compo = $this->getRecipeByIdProduct($product['id']);
            $product['recipe'] = $compo;
            $optionCompo = $this->getOptionRecipeByIdProduct($product['id']);

            $product['option_recipe'] = $optionCompo;

            $results[] =$product;
        }
        return $results;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getRecipeByIdProduct($id)
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
    public function getOptionRecipeByIdProduct($id){

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