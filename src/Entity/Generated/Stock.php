<?php
/**
 * Entity Stock
 * Auto Generate :2015-06-25 00:37:15
 * stock
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class Stock implements Entity
{

   /**
    * Primary key
    *
    * @var int
    */
   private $id = null;

   /**
    * Primary key
    *
    * Relation Many To One
    * Table-target prima_products prm_id
    *
    * @var int
    */
   private $prmId = null;

   /**
    * @var float
    */
   private $quantity = null;

   /**
    * @var int
    */
   private $movement = null;

   /**
    * @var \DateTime
    */
   private $datetime = null;

   /**
    * Primary key
    *
    * Relation Many To One
    * Table-target staff stf_id
    *
    * @var int
    */
   private $staffId = null;

   /**
    * @var float
    */
   private $price = null;

   /**
    * Relation Many To Many
    * Table-target event evn_id
    *
    * @var int
    */
   private $eventId = null;

   /**
    * @var float
    */
   private $warning = null;

   /**
    * set default var \Datetime 
    */
   function __construct()
   {
       $this->datetime = new \DateTime("now");
   }

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("id", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("id", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("prmId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("prmId", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("quantity", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("movement", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("movement", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("datetime", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("staffId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("staffId", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("price", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("eventId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("eventId", new Assert\NotBlank(array("message" => "Not null")));
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
    * @return int
    */
   public function getPrmId()
   {
       return $this->prmId;
   }

   /**
    * @param int $prmId
    */
   public function setPrmId($prmId)
   {
       $this->prmId = $prmId;
   }

   /**
    * @return float
    */
   public function getQuantity()
   {
       return $this->quantity;
   }

   /**
    * @param float $quantity
    */
   public function setQuantity($quantity)
   {
       $this->quantity = $quantity;
   }

   /**
    * @return int
    */
   public function getMovement()
   {
       return $this->movement;
   }

   /**
    * @param int $movement
    */
   public function setMovement($movement)
   {
       $this->movement = $movement;
   }

   /**
    * @return \DateTime
    */
   public function getDatetime()
   {
       return $this->datetime;
   }

   /**
    * @param \DateTime $datetime
    */
   public function setDatetime($datetime)
   {
       $this->datetime = $datetime;
   }

   /**
    * @return int
    */
   public function getStaffId()
   {
       return $this->staffId;
   }

   /**
    * @param int $staffId
    */
   public function setStaffId($staffId)
   {
       $this->staffId = $staffId;
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
    * @return int
    */
   public function getEventId()
   {
       return $this->eventId;
   }

   /**
    * @param int $eventId
    */
   public function setEventId($eventId)
   {
       $this->eventId = $eventId;
   }

   /**
    * @return float
    */
   public function getWarning()
   {
       return $this->warning;
   }

   /**
    * @param float $warning
    */
   public function setWarning($warning)
   {
       $this->warning = $warning;
   }

   /**
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "stk_id" => $this->id,
            "stk_prm_id" => $this->prmId,
            "stk_quantity" => $this->quantity,
            "stk_movement" => $this->movement,
            "stk_datetime" => $this->datetime,
            "stk_staff_id" => $this->staffId,
            "stk_price" => $this->price,
            "stk_event_id" => $this->eventId,
            "stk_warning" => $this->warning,
       );
       if($this->datetime instanceof \DateTime){
           $entity["stk_datetime"] = date_format($this->dateStart, "Y-m-d H:i:s");
       }
       return $entity;
   }

}
