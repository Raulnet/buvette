<?php
/**
 * Entity ProductsHasOrder
 * Auto Generate :2015-06-25 00:37:15
 * products_has_order
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class ProductsHasOrder implements Entity
{

   /**
    * Primary key
    *
    * Relation Many To One
    * Table-target products pro_id
    *
    * @var int
    */
   private $id = null;

   /**
    * Relation Many To Many
    * Table-target order ord_id
    *
    * @var int
    */
   private $id = null;

   /**
    * @var float
    */
   private $proQuantity = null;

   /**
    * Relation Many To Many
    * Table-target combo_products cmb_id
    *
    * @var int
    */
   private $id = null;

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("id", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("id", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("id", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("id", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("proQuantity", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("id", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
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
    * @return float
    */
   public function getProQuantity()
   {
       return $this->proQuantity;
   }

   /**
    * @param float $proQuantity
    */
   public function setProQuantity($proQuantity)
   {
       $this->proQuantity = $proQuantity;
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
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "pro_id" => $this->id,
            "ord_id" => $this->id,
            "ord_pro_quantity" => $this->proQuantity,
            "cmb_id" => $this->id,
       );
       return $entity;
   }

}
