<?php
/**
 * Entity EventHasProducts
 * Auto Generate :2015-06-25 00:37:15
 * event_has_products
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class EventHasProducts implements Entity
{

   /**
    * Primary key
    *
    * Relation Many To One
    * Table-target event evn_id
    *
    * @var int
    */
   private $evnId = null;

   /**
    * Primary key
    *
    * Relation Many To One
    * Table-target products pro_id
    *
    * @var int
    */
   private $proId = null;

   /**
    * @var string
    */
   private $price = null;

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("evnId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("evnId", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("proId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("proId", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("price", new Assert\Length(array("max" => 45, "maxMessage" => "trop long")));
    }

   /**
    * @return int
    */
   public function getEvnId()
   {
       return $this->evnId;
   }

   /**
    * @param int $evnId
    */
   public function setEvnId($evnId)
   {
       $this->evnId = $evnId;
   }

   /**
    * @return int
    */
   public function getProId()
   {
       return $this->proId;
   }

   /**
    * @param int $proId
    */
   public function setProId($proId)
   {
       $this->proId = $proId;
   }

   /**
    * @return string
    */
   public function getPrice()
   {
       return $this->price;
   }

   /**
    * @param string $price
    */
   public function setPrice($price)
   {
       $this->price = $price;
   }

   /**
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "ehp_evn_id" => $this->evnId,
            "ehp_pro_id" => $this->proId,
            "ehp_price" => $this->price,
       );
       return $entity;
   }

}
