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
     * @var string
     */
    protected $primaryKey = 'evn_id';

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