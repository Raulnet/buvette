<?php
/**
 * Data Access Object DAO Event
 * Auto Generate :2015-06-25 00:37:15
 * event
 */
namespace buvette\DAO\Generated;

use buvette\Entity\Generated\Event;

class EventZDAO extends ZDAO {

    /**
     * @var string table Entity
     */
    protected $table = "event";

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = "evn_id";

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        parent::__construct($configArray);
    }

    /**
     * @param $row
     * @return Event
     */
    protected function buildZEntityObject($row)
    {
        $entity = new Event();
        $entity->setId($row["evn_id"]);
        $entity->setStart($row["evn_start"]);
        $entity->setEnd($row["evn_end"]);
        $entity->setTitle($row["evn_title"]);
        $entity->setStfIdCreat($row["evn_stf_id_creat"]);
        $entity->setDateCreated($row["evn_date_created"]);
        $entity->setDeleted($row["evn_deleted"]);
        $entity->setDateDeleted($row["evn_date_deleted"]);
        $entity->setDateModified($row["evn_date_modified"]);
        $entity->setStfIdDelet($row["evn_stf_id_delet"]);
        $entity->setStfIdModif($row["evn_stf_id_modif"]);
        return $entity;
    }

}