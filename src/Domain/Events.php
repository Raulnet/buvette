<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 25/05/15
 * Time: 21:48
 */
namespace buvette\Domain;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class Events implements Entity
{

    /**
     * @var int
     */
    private $id = null;

    /**
     * @var Datetime
     */
    private $dateStart = null;

    /**
     * @var Datetime
     */
    private $dateEnd = null;

    /**
     * @var string
     */
    private $title = null;

    /**
     * @var int
     */
    private $staffIdCreate = null;

    /**
     * @var Datetime
     */
    private $dateCreated = null;

    /**
     * @var int
     */
    private $deleted = 0;

    /**
     * @var Datetime
     */
    private $dateDeleted = null;

    /**
     * @var int
     */
    private $staffIdDeleted = null;

    /**
     * @var Datetime
     */
    private $dateModified = null;

    /**
     * @var int
     */
    private $staffIdModified = null;

    /**
     * set default DateCreation
     */
    function __construct()
    {
        $this->dateCreated = new \DateTime('now');
        $this->dateStart   = new \DateTime('now');
        $this->dateEnd   = new \DateTime('now');
    }

    /**
     * @param ClassMetadata $metadata
     */
    static public function loadValidatorMetadata(ClassMetadata $metadata){

        $metadata->addPropertyConstraint('title', new Assert\NotBlank(array('message' => 'le titre doit être renseigner')));
        $metadata->addPropertyConstraint('title', new Assert\Length(array('max' => 45, 'maxMessage' => 'Le titre est trop long')));
    }

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
     * @return Datetime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param Datetime $dateStart
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return Datetime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param Datetime $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
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
     * @return int
     */
    public function getStaffIdCreate()
    {
        return $this->staffIdCreate;
    }

    /**
     * @param int $staffIdCreate
     */
    public function setStaffIdCreate($staffIdCreate)
    {
        $this->staffIdCreate = $staffIdCreate;
    }

    /**
     * @return Datetime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param Datetime $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return int
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param int $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return Datetime
     */
    public function getDateDeleted()
    {
        return $this->dateDeleted;
    }

    /**
     * @param Datetime $dateDeleted
     */
    public function setDateDeleted($dateDeleted)
    {
        $this->dateDeleted = $dateDeleted;
    }

    /**
     * @return int
     */
    public function getStaffIdDeleted()
    {
        return $this->staffIdDeleted;
    }

    /**
     * @param int $staffIdDeleted
     */
    public function setStaffIdDeleted($staffIdDeleted)
    {
        $this->staffIdDeleted = $staffIdDeleted;
    }

    /**
     * @return Datetime
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * @param Datetime $dateModified
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;
    }

    /**
     * @return int
     */
    public function getStaffIdModified()
    {
        return $this->staffIdModified;
    }

    /**
     * @param int $staffIdModified
     */
    public function setStaffIdModified($staffIdModified)
    {
        $this->staffIdModified = $staffIdModified;
    }

    /**
     * @return array Entity
     */
    public function getArray()
    {
        $entity = array(
            'evn_id'           => $this->id,
            'evn_title'        => $this->title,
            'evn_start'        => $this->dateStart,
            'evn_end'          => $this->dateEnd,
            'evn_stf_id_creat' => $this->staffIdCreate,
            'evn_date_created' => $this->dateCreated,
            'evn_deleted'      => $this->deleted,
            'evn_stf_id_delet' => $this->staffIdDeleted,
            'evn_stf_id_modif' => $this->staffIdModified
        );
        if($this->dateStart instanceof \DateTime){
            $entity['evn_start'] = date_format($this->dateStart, 'Y-m-d H:i:s');
        }
        if($this->dateEnd instanceof \DateTime){
            $entity['evn_end'] = date_format($this->dateEnd, 'Y-m-d H:i:s');
        }
        if($this->dateCreated instanceof \DateTime){
            $entity['evn_date_created'] = date_format($this->dateCreated, 'Y-m-d H:i:s');
        }
        if ($this->dateDeleted != null) {
            $entity['evn_date_deleted'] = date_format($this->dateDeleted, 'Y-m-d H:i:s');
        }
        if ($this->dateModified != null) {
            $entity['evn_date_modified'] = date_format($this->dateModified, 'Y-m-d H:i:s');
        }
        return $entity;
    }


}