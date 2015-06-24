<?php
/**
 * Entity OptionRecette
 * Auto Generate :2015-06-25 00:37:15
 * option_recette
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class OptionRecette implements Entity
{

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
    * Primary key
    *
    * Relation Many To One
    * Table-target products pro_id
    *
    * @var int
    */
   private $proId = null;

   /**
    * @var float
    */
   private $prmQuantity = null;

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("prmId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("prmId", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("proId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("proId", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("prmQuantity", new Assert\NotBlank(array("message" => "Not null")));
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
    * @return float
    */
   public function getPrmQuantity()
   {
       return $this->prmQuantity;
   }

   /**
    * @param float $prmQuantity
    */
   public function setPrmQuantity($prmQuantity)
   {
       $this->prmQuantity = $prmQuantity;
   }

   /**
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "ore_prm_id" => $this->prmId,
            "ore_pro_id" => $this->proId,
            "ore_prm_quantity" => $this->prmQuantity,
       );
       return $entity;
   }

}
