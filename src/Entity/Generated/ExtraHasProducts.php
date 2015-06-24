<?php
/**
 * Entity ExtraHasProducts
 * Auto Generate :2015-06-25 00:37:15
 * extra_has_products
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class ExtraHasProducts implements Entity
{

   /**
    * Primary key
    *
    * Relation Many To One
    * Table-target extra ext_id
    *
    * @var int
    */
   private $extId = null;

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
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("extId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("extId", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("proId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("proId", new Assert\NotBlank(array("message" => "Not null")));
    }

   /**
    * @return int
    */
   public function getExtId()
   {
       return $this->extId;
   }

   /**
    * @param int $extId
    */
   public function setExtId($extId)
   {
       $this->extId = $extId;
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
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "ehp_ext_id" => $this->extId,
            "ehp_pro_id" => $this->proId,
       );
       return $entity;
   }

}
