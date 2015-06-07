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
     * @return Player
     */
    public function findOneById($id)
    {

        $select = $this->sql->select();
        $select->where(array('uni_id' => $id));
        $row = $this->selectWith($select)->current();

        return $this->buildZDomainObject($row);
    }

    /**
     * Create a new Entity
     *
     * @param Unities $unities
     *
     * @return bool
     */
    public function createEntity(Unities $unities)
    {
        if (!$unities->getId()) {
            $this->insert($unities->getArray());
            return true;
        }
        return false;
    }

    /**
     * Update Entity
     *
     * @param Unities $unities
     * @return bool
     */
    public function updateEntity(Unities $unities)
    {
        if ($unities->getId()) {
            $where = array('uni_id' => $unities->getId());
            $this->update($unities->getArray(), $where);
            return true;
        }
        return false;
    }

    /**
     * Delete Unities Entity
     *
     * @param Unities $unities
     * @return bool
     */
    public function deleteEntity(Unities $unities)
    {
        if ($unities->getId()) {
            $where = array('uni_id' => $unities->getId());
            $this->delete($where);
            return true;
        }
        return false;
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





} // END CLASS !!!