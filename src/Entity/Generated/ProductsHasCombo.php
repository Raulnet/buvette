<?php
/**
 * Entity ProductsHasCombo
 * Auto Generate :2015-06-25 00:37:15
 * products_has_combo
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class ProductsHasCombo implements Entity
{

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
    * Primary key
    *
    * Relation Many To One
    * Table-target combo_products cmb_id
    *
    * @var int
    */
   private $cmbId = null;

   /**
    * @var int
    */
   private $quantity = null;

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("proId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("proId", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("cmbId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("cmbId", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("quantity", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("quantity", new Assert\NotBlank(array("message" => "Not null")));
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
    * @return int
    */
   public function getCmbId()
   {
       return $this->cmbId;
   }

   /**
    * @param int $cmbId
    */
   public function setCmbId($cmbId)
   {
       $this->cmbId = $cmbId;
   }

   /**
    * @return int
    */
   public function getQuantity()
   {
       return $this->quantity;
   }

   /**
    * @param int $quantity
    */
   public function setQuantity($quantity)
   {
       $this->quantity = $quantity;
   }

   /**
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "phc_pro_id" => $this->proId,
            "phc_cmb_id" => $this->cmbId,
            "phc_quantity" => $this->quantity,
       );
       return $entity;
   }

}
