<?php
/**
 * Entity Products
 * Auto Generate :2015-06-25 00:37:15
 * products
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class Products implements Entity
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
    * Primary key
    *
    * Relation Many To One
    * Table-target categories_products cat_id
    *
    * @var int
    */
   private $catId = null;

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("id", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("id", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("title", new Assert\Length(array("max" => 45, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("catId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("catId", new Assert\NotBlank(array("message" => "Not null")));
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
    * @return int
    */
   public function getCatId()
   {
       return $this->catId;
   }

   /**
    * @param int $catId
    */
   public function setCatId($catId)
   {
       $this->catId = $catId;
   }

   /**
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "pro_id" => $this->id,
            "pro_title" => $this->title,
            "pro_cat_id" => $this->catId,
       );
       return $entity;
   }

}
