<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 17/05/15
 * Time: 21:58
 */

namespace buvette\DAO;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;

abstract class ZDAO extends AbstractTableGateway {

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        $this->adapter = new Adapter($configArray);
        $this->sql = new Sql($this->adapter, $this->table);
    }

    /**
     * Builds a domain object from a ZDB row.
     * Must be overridden by child classes.
     */
    protected abstract function buildZDomainObject($row);
}