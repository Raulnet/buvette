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
     * @var string
     */
    protected $primaryKey = 'cat_id';

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
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