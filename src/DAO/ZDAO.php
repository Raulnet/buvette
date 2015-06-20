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
use buvette\Domain\Entity;

abstract class ZDAO extends AbstractTableGateway
{

    /**
     * @var array
     */
    protected $where = array();

    /**
     * @var string
     */
    protected $primaryKey = null;

    /**
     * @var string
     */
    protected $foreignKey1 = null;

    /**
     * @var string
     */
    protected $foreignKey2 = null;

    /**
     * @param $configArray
     */
    function __construct($configArray)
    {
        $this->adapter = new Adapter($configArray);
        $this->sql     = new Sql($this->adapter, $this->table);
    }

    /**
     * Builds a domain object from a ZDB row.
     * Must be overridden by child classes.
     *
     * @param $row
     */
    protected abstract function buildZDomainObject($row);

    /**
     * @param      $data
     * @param null $data2
     *
     * @return bool
     */
    protected function setWhere($data, $data2 = null)
    {
        // if is an Object set to array
        if ($data instanceof Entity) {

            $data = $data->getArray();
        }
        // if is an array
        if (is_array($data)) {
            if (array_key_exists($this->primaryKey, $data)) {
                $this->where = array(
                    $this->primaryKey => $data[$this->primaryKey]);
                return true;
            }
            if (array_key_exists($this->foreignKey1, $data)) {
                $this->where = array(
                    $this->foreignKey1 =>$data[$this->foreignKey1],
                    $this->foreignKey2 =>$data[$this->foreignKey2] );
                return true;
            }
            return false;
        }
        // filter to INT
        $data = filter_var($data, FILTER_VALIDATE_INT);
        // if is int
        if ($data !== null && $data2 === null) {
            $this->where = array($this->primaryKey => $data);
            return true;
        }
        // filter to INT
        $data2 = filter_var($data2, FILTER_VALIDATE_INT);
        // if is int
        if ($data !== null && $data2 !== null) {
            $this->where = array($this->foreignKey1 => $data, $this->foreignKey2 => $data2);
            return true;
        }

        return false;
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
     * @param array $where
     *
     * @return array Entities
     */
    public function find(array $where)
    {
        $select = $this->sql->select();
        $select->where($where);
        $result = $this->selectWith($select)->toArray();
        $entities = array();
        foreach ($result as $row) {
            $entities[] = $this->buildZDomainObject($row);
        }

        return $entities;
    }

    /**
     * @param      $data
     * @param null $data2
     *
     * @return Entity
     */
    public function findOneById($data, $data2 = null)
    {
        $this->setWhere($data, $data2);


        $select = $this->sql->select();
        $select->where($this->where);
        $row = $this->selectWith($select)->current();
        if($row){
            return $this->buildZDomainObject($row);
        }
        return false;
    }

    /**
     * Create Entity
     *
     * @param array $data | Entity $data
     *
     * @return bool
     */
    public function createEntity($data)
    {
        if ($data instanceof Entity) {
            $data = $data->getArray();
        }
        if (array_key_exists($this->primaryKey, $data)) {
            $this->insert($data);
            return true;
        }
        if ($data[$this->foreignKey1] && $data[$this->foreignKey2]) {
            if(!$this->findOneById($data[$this->foreignKey1], $data[$this->foreignKey2])){
                $this->insert($data);
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Update Entity
     *
     * @param array $data | Entity $data
     *
     * @return bool
     */
    public function updateEntity($data)
    {
        if ($data instanceof Entity)  {
            $data = $data->getArray();
        }
        $this->setWhere($data);
        if (array_key_exists($this->primaryKey, $data)) {
            $this->update($data, $this->where);
            return true;
        }
        if ($data[$this->foreignKey1] && $data[$this->foreignKey2]) {
            if($this->findOneById($data[$this->foreignKey1], $data[$this->foreignKey2])){
                $this->update($data, $this->where);
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Delete Entity
     *
     * @param array $data | Entity $data
     *
     * @return bool
     */
    public function deleteEntity($data)
    {
        if($this->setWhere($data)){
            $this->delete($this->where);
            return true;
        }
        return false;
    }

}