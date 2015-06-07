<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 24/05/15
 * Time: 12:11
 */

namespace buvette\Domain;


class Unities {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return array Entity
     */
    public function getArray(){

        return array(
            'uni_id' => $this->id,
            'uni_title' => $this->title
        );
    }
}