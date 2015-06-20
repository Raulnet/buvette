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
    protected $secondaryKey = null;

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
        // if is an instance of Entity Object set to array
        if ($data instanceof Entity) {

            $data = $data->getArray();
        }
        // if is an array
        if (is_array($data)) {
            if (array_key_exists($this->primaryKey, $data)) {
                $this->where[$this->primaryKey] = $data[$this->primaryKey];
            }
            if (array_key_exists($this->secondaryKey, $data)) {
                $this->where[$this->secondaryKey] =$data[$this->secondaryKey];
            }
            if($this->where){
                return true;
            }
            return false;
        }
        if(is_numeric($data)){
            // filter to INT
            $data = filter_var($data, FILTER_VALIDATE_INT);
            $this->where[$this->primaryKey] = $data;
        }
        if(ctype_alnum($data)){
            // filter to INT
            $this->where[$this->primaryKey] = $data;
        }
        if(is_numeric($data2)){
            // filter to INT
            $data2 = filter_var($data2, FILTER_VALIDATE_INT);
            $this->where[$this->secondaryKey] = $data2;
        }
        if(ctype_alnum($data2)){
            // filter to INT
            $this->where[$this->secondaryKey] = $data2;
        }
        if($this->where){
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
            if ($data[$this->primaryKey] == null) {
                if($this->insert($data)){
                    return true;
                };
                return false;
            }
            if ($data[$this->secondaryKey] && $data[$this->primaryKey]) {
                if(!$this->findOneById($data[$this->secondaryKey], $data[$this->primaryKey])){
                    if($this->insert($data)){
                        return true;
                    };
                    return false;
                }
                return false;
            }
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
        if($data instanceof Entity){
            $data = $data->getArray();
        }

        if ($this->setWhere($data))  {
                if($this->update($data, $this->where)){
                    return true;
                };
            }
        return false;
    }

    /**
     * Delete Entity
     *
     * @param Entity $data
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