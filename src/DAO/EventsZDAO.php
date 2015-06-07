<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 25/05/15
 * Time: 21:55
 */

namespace buvette\DAO;

use buvette\Domain\Events;

class EventsZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = 'event';

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
     * @return Events
     */
    public function findOneById($id)
    {

        $select = $this->sql->select();
        $select->where(array('evn_id' => $id));
        $row = $this->selectWith($select)->current();

        return $this->buildZDomainObject($row);
    }

    /**
     * Create a new Entity
     *
     * @param Events $event
     *
     * @return bool
     */
    public function createEntity(Events $event)
    {
        if (!$event->getId()) {
            $this->insert($event->getArray());
            return true;
        }
        return false;
    }

    /**
     * Update Entity
     *
     * @param Events $event
     *
     * @return bool
     */
    public function updateEntity(Events $event)
    {
        if ($event->getId()) {
            $where = array('evn_id' => $event->getId());
            $this->update($event->getArray(), $where);
            return true;
        }
        return false;
    }

    /**
     * Delete Player Entity
     *
     * @param Events $event
     *
     * @return bool
     */
    public function deleteEntity(Events $event)
    {

        if ($event->getId()) {
            $where = array('evn_id' => $event->getId());
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

        $event = new Events();
        $event->setId($row['evn_id']);
        $event->setTitle($row['evn_title']);
        $event->setDateStart($row['evn_start']);
        $event->setDateEnd($row['evn_end']);
        $event->setStaffIdCreate($row['evn_stf_id_creat']);
        $event->setDateCreated($row['evn_date_created']);
        $event->setDeleted($row['evn_deleted']);
        $event->setDateDeleted($row['evn_date_deleted']);
        $event->setDateModified($row['evn_date_modified']);
        $event->setStaffIdDeleted($row['evn_stf_id_delet']);
        $event->setStaffIdDeleted($row['evn_stf_id_delet']);

        return $event;
    }




}