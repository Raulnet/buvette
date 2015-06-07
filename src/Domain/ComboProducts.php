<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 24/05/15
 * Time: 19:26
 */

namespace buvette\Domain;


class ComboProducts {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var float
     */
    private $price;

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
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return array Entity
     */
    public function getArray(){

        return array(
            'cmb_id' => $this->id,
            'cmb_title' => $this->title,
            'cmb_price' => $this->price
        );
    }



} // END CLASS !!!