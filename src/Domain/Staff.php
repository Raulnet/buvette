<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 23/05/15
 * Time: 22:46
 */

namespace buvette\Domain;


class Staff {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array Entity
     */
    public function getArray(){

        return array(
            'stf_id' => $this->id,
            'stf_name' => $this->nickname
        );
    }

} // END CLASS !!!!