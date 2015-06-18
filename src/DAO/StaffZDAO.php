<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 23/05/15
 * Time: 22:55
 */
namespace buvette\DAO;

use buvette\Domain\Staff;

class StaffZDAO extends ZDAO
{

    /**
     * @var string table Entity
     */
    protected $table = 'staff';

    protected $primaryKey = 'stf_id';

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     *
     * @return Staff
     */
    protected function buildZDomainObject($row)
    {
        $staff = new Staff();
        $staff->setId($row['stf_id']);
        $staff->setName($row['stf_name']);

        return $staff;
    }

}