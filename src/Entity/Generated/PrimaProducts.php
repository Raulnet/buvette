<?php
/**
 * Entity PrimaProducts
 * Auto Generate :2015-06-25 00:37:15
 * prima_products
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class PrimaProducts implements Entity
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
    * Table-target unities uni_id
    *
    * @var int
    */
   private $uniId = null;

   /**
    * Primary key
    *
    * Relation Many To One
    * Table-target categories_prima_products cpp_id
    *
    * @var int
    */
   private $category = null;

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("id", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("id", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("title", new Assert\Length(array("max" => 45, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("title", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("uniId", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("uniId", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("category", new Assert\Length(array("max" => 11, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("category", new Assert\NotBlank(array("message" => "Not null")));
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
   public function getUniId()
   {
       return $this->uniId;
   }

   /**
    * @param int $uniId
    */
   public function setUniId($uniId)
   {
       $this->uniId = $uniId;
   }

   /**
    * @return int
    */
   public function getCategory()
   {
       return $this->category;
   }

   /**
    * @param int $category
    */
   public function setCategory($category)
   {
       $this->category = $category;
   }

   /**
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "prm_id" => $this->id,
            "prm_title" => $this->title,
            "prm_uni_id" => $this->uniId,
            "prm_category" => $this->category,
       );
       return $entity;
   }

}
