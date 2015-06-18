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
     * @var string
     */
    protected $primaryKey = 'ccp_id';

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return CategoriesPrimaProduct
     */
    protected function buildZDomainObject($row)
    {

        $catPrimProd = new CategoriesPrimaProduct();
        $catPrimProd->setId($row['cpp_id']);
        $catPrimProd->setTitle($row['cpp_title']);

        return $catPrimProd;
    }





} // END CLASS !!!