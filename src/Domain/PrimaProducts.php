<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 24/05/15
 * Time: 14:25
 */

namespace buvette\Domain;

class PrimaProducts implements Entity {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $categoryId;

    /**
     * @var int
     */
    private $unityId;

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
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return mixed
     */
    public function getUnityId()
    {
        return $this->unityId;
    }

    /**
     * @param mixed $unityId
     */
    public function setUnityId($unityId)
    {
        $this->unityId = $unityId;
    }

    /**
     * @return array Entity
     */
    public function getArray(){

        return array(
            'prm_id' => $this->id,
            'prm_title' => $this->title,
            'prm_uni_id' => $this->getUnityId(),
            'prm_category' => $this->getCategoryId()
        );
    }





} // END CLASS !!!