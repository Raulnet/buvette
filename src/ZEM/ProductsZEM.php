<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 28/06/15
 * Time: 14:23
 */

namespace buvette\ZEM;

use buvette\ZEM\Generated\ProductsZEM as ProductsZEMLegacy;

class ProductsZEM extends ProductsZEMLegacy{

    /**
     * @return mixed
     */
    public function getAllData(){

        $select = $this->sql->select();
        $select->columns(array('id' => 'pro_id', 'title' => 'pro_title'));
        $select->join(array('c' => 'categories_products'), 'c.cat_id = pro_category_id', array('catTitle' => 'cat_title'));
        $products = $this->selectWith($select)->toArray();

        $productsFullStack = array();

        foreach($products as $product){

            $product['recipe'] = $this->getRecipeByProductId($product['id']);
            $productsFullStack[] = $product;
        }

        return $productsFullStack;
    }

    /**
     * @param $productId
     *
     * @return mixed
     */
    public function getRecipeByProductId($productId){
        $select = $this->sql->select();

        $select->columns(array('id' => 'pro_id', 'title' => 'pro_title'));
        $select->join(array('r' => 'recipe'), 'r.rec_product_id = pro_id', array('quantity' => 'rec_prim_product_quantity'))
                ->join(array('pr' => 'prim_products'), 'pr.prp_id = r.rec_prim_product_id', array('prm_id' => 'prp_id', 'prmTitle' => 'prp_title'))
                ->join(array('u' => 'unities'), 'u.uni_id = prp_unities_id', array('uniTitle' => 'uni_title'))
                ->join(array('c' => 'categories_prim_products'), 'c.cpp_id = prp_categories_id', array('catTitle' => 'cpp_title'))
                ->where(array('pro_id' => $productId));
        return $this->selectWith($select)->toArray();
    }

}