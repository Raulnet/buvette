<?php
/**
 * Entity Extra
 * Auto Generate :2015-06-25 00:37:15
 * extra
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class Extra implements Entity
{

   /**
    * Primary key
    *
    * @var int
    */
   private $id = null;

   /**
    * Relation Many To Many
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
    * @var float
    */
   private $price = null;

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
            $metadata->addPropertyConstraint("price", new Assert\NotBlank(array("message" => "Not null")));
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
   public function getArray()
   {
       $entity = array(
            "ext_id" => $this->id,
            "ext_prm_id" => $this->prmId,
            "ext_quantity" => $this->quantity,
            "ext_price" => $this->price,
       );
       return $entity;
   }

}
