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
     * @return Staff
     */
    public function findOneById($id)
{

    $select = $this->sql->select();
    $select->where(array('stf_id' => $id));
    $row = $this->selectWith($select)->current();

    return $this->buildZDomainObject($row);
}

    /**
     * Create a new Entity
     *
     * @param Staff $staff
     * @return bool
     */
    public function createEntity(Staff $staff)
    {
        if (!$staff->getId()) {
            $this->insert($staff->getArray());
            return true;
        }
        return false;
    }

    /**
     * Update Entity
     *
     * @param Staff $staff
     * @return bool
     */
    public function updateEntity(Staff $staff)
    {
        if ($staff->getId()) {
            $where = array('stf_id' => $staff->getId());
            $this->update($staff->getArray(), $where);
            return true;
        }
        return false;
    }

    /**
     * Delete Player Entity
     *
     * @param Staff $staff
     *
     * @return bool
     */
    public function deleteEntity(Staff $staff)
    {
        if ($staff->getId()) {
            $where = array('stf_id' => $staff->getId());
            $this->delete($where);
            return true;
        }
        return false;
    }

    /**
     * @param $row
     * @return Staff
     */
    protected function buildZDomainObject($row)
    {

        $staff = new Staff();
        $staff->setId($row['stf_id']);
        $staff->setName($row['stf_name']);

        return $staff;
    }

} // END CLASS !!!