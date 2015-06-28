<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 28/06/15
 * Time: 10:10
 */

namespace buvette\ZEM;
use buvette\ZEM\Generated\PrimProductsZEM as PrimProductsZEMLegacy;


class PrimProductsZEM extends PrimProductsZEMLegacy {

    public function getAllData(){

        $select = $this->sql->select();
        $select->columns(array('id' => 'prp_id', 'title' => 'prp_title'))
            ->join(array('u' => 'unities'), 'u.uni_id = prp_unities_id', array('uniTitle' => 'uni_title'))
            ->join(array('c' => 'categories_prim_products'), 'c.cpp_id = prp_categories_id', array('catTitle' => 'cpp_title'));
        $primProducts = $this->selectWith($select)->toArray();
        if($primProducts){
            return $primProducts;
        }
        return false;
    }

    public function getOneAllDataById($productId){

        $select = $this->sql->select();
        $select->columns(array('id' => 'prp_id', 'title' => 'prp_title'))
            ->join(array('u' => 'unities'), 'u.uni_id = prp_unities_id', array('uniTitle' => 'uni_title'))
            ->join(array('c' => 'categories_prim_products'), 'c.cpp_id = prp_categories_id', array('catTitle' => 'cpp_title'))
            ->where(array('prp_id' => $productId));
        $primProducts = $this->selectWith($select)->current();
        if($primProducts){
            return $primProducts;
        }
        return false;
    }

}