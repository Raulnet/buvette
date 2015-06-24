<?php
/**
 * Entity Staff
 * Auto Generate :2015-06-25 00:37:15
 * staff
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class Staff implements Entity
{

   /**
    * Primary key
    *
    * @var int
    */
   private $id = null;

   /**
    * @var string
    */
   private $name = null;

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("id", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("id", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("name", new Assert\Length(array("max" => 45, "maxMessage" => "trop long")));
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
    * @return string
    */
   public function getName()
   {
       return $this->name;
   }

   /**
    * @param string $name
    */
   public function setName($name)
   {
       $this->name = $name;
   }

   /**
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "stf_id" => $this->id,
            "stf_name" => $this->name,
       );
       return $entity;
   }

}
