<?php
/**
 * Entity Unities
 * Auto Generate :2015-06-25 00:37:15
 * unities
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class Unities implements Entity
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
   private $title = null;

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("id", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("id", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("title", new Assert\Length(array("max" => 45, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("title", new Assert\NotBlank(array("message" => "Not null")));
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
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "uni_id" => $this->id,
            "uni_title" => $this->title,
       );
       return $entity;
   }

}
