<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 24/05/15
 * Time: 12:14
 */

namespace buvette\DAO;

use buvette\Domain\Unities;

class UnitiesZDAO extends ZDAO{

    /**
     * @var string table Entity
     */
    protected $table = 'unities';

    /**
     * @var string
     */
    protected $primaryKey = 'uni_id';

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return Unities
     */
    protected function buildZDomainObject($row)
    {

        $unities = new Unities;
        $unities->setId($row['uni_id']);
        $unities->setTitle($row['uni_title']);

        return $unities;
    }

}