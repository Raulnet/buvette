<?php
/**
 * Entity Event
 * Auto Generate :2015-06-25 00:37:15
 * event
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class Event implements Entity
{

   /**
    * Primary key
    *
    * @var int
    */
   private $id = null;

   /**
    * @var \DateTime
    */
   private $start = null;

   /**
    * @var \DateTime
    */
   private $end = null;

   /**
    * @var string
    */
   private $title = null;

   /**
    * Relation Many To Many
    * Table-target staff stf_id
    *
    * @var int
    */
   private $stfIdCreat = null;

   /**
    * @var \DateTime
    */
   private $dateCreated = null;

   /**
    * @var int
    */
   private $deleted = null;

   /**
    * @var \DateTime
    */
   private $dateDeleted = null;

   /**
    * @var \DateTime
    */
   private $dateModified = null;

   /**
    * @var int
    */
   private $stfIdDelet = null;

   /**
    * @var int
    */
   private $stfIdModif = null;

   /**
    * set default var \Datetime 
    */
   function __construct()
   {
       $this->start = new \DateTime("now");
       $this->end = new \DateTime("now");
       $this->dateCreated = new \DateTime("now");
       $this->dateDeleted = new \DateTime("now");
       $this->dateModified = new \DateTime("now");
   }

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("id", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("id", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("start", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("end", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("title", new Assert\Length(array("max" => 45, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("title", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("stfIdCreat", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("stfIdCreat", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("dateCreated", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("deleted", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("deleted", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("stfIdDelet", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("stfIdModif", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
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
    * @return \DateTime
    */
   public function getStart()
   {
       return $this->start;
   }

   /**
    * @param \DateTime $start
    */
   public function setStart($start)
   {
       $this->start = $start;
   }

   /**
    * @return \DateTime
    */
   public function getEnd()
   {
       return $this->end;
   }

   /**
    * @param \DateTime $end
    */
   public function setEnd($end)
   {
       $this->end = $end;
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
   public function getStfIdCreat()
   {
       return $this->stfIdCreat;
   }

   /**
    * @param int $stfIdCreat
    */
   public function setStfIdCreat($stfIdCreat)
   {
       $this->stfIdCreat = $stfIdCreat;
   }

   /**
    * @return \DateTime
    */
   public function getDateCreated()
   {
       return $this->dateCreated;
   }

   /**
    * @param \DateTime $dateCreated
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
    * @return \DateTime
    */
   public function getDateDeleted()
   {
       return $this->dateDeleted;
   }

   /**
    * @param \DateTime $dateDeleted
    */
   public function setDateDeleted($dateDeleted)
   {
       $this->dateDeleted = $dateDeleted;
   }

   /**
    * @return \DateTime
    */
   public function getDateModified()
   {
       return $this->dateModified;
   }

   /**
    * @param \DateTime $dateModified
    */
   public function setDateModified($dateModified)
   {
       $this->dateModified = $dateModified;
   }

   /**
    * @return int
    */
   public function getStfIdDelet()
   {
       return $this->stfIdDelet;
   }

   /**
    * @param int $stfIdDelet
    */
   public function setStfIdDelet($stfIdDelet)
   {
       $this->stfIdDelet = $stfIdDelet;
   }

   /**
    * @return int
    */
   public function getStfIdModif()
   {
       return $this->stfIdModif;
   }

   /**
    * @param int $stfIdModif
    */
   public function setStfIdModif($stfIdModif)
   {
       $this->stfIdModif = $stfIdModif;
   }

   /**
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "evn_id" => $this->id,
            "evn_start" => $this->start,
            "evn_end" => $this->end,
            "evn_title" => $this->title,
            "evn_stf_id_creat" => $this->stfIdCreat,
            "evn_date_created" => $this->dateCreated,
            "evn_deleted" => $this->deleted,
            "evn_date_deleted" => $this->dateDeleted,
            "evn_date_modified" => $this->dateModified,
            "evn_stf_id_delet" => $this->stfIdDelet,
            "evn_stf_id_modif" => $this->stfIdModif,
       );
       if($this->start instanceof \DateTime){
           $entity["evn_start"] = date_format($this->dateStart, "Y-m-d H:i:s");
       }
       if($this->end instanceof \DateTime){
           $entity["evn_end"] = date_format($this->dateStart, "Y-m-d H:i:s");
       }
       if($this->dateCreated instanceof \DateTime){
           $entity["evn_date_created"] = date_format($this->dateStart, "Y-m-d H:i:s");
       }
       if($this->dateDeleted instanceof \DateTime){
           $entity["evn_date_deleted"] = date_format($this->dateStart, "Y-m-d H:i:s");
       }
       if($this->dateModified instanceof \DateTime){
           $entity["evn_date_modified"] = date_format($this->dateStart, "Y-m-d H:i:s");
       }
       return $entity;
   }

}
