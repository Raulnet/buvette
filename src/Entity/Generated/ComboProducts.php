<?php
/**
 * Entity ComboProducts
 * Auto Generate :2015-06-25 00:37:15
 * combo_products
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class ComboProducts implements Entity
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
            $metadata->addPropertyConstraint("title", new Assert\Length(array("max" => 45, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("title", new Assert\NotBlank(array("message" => "Not null")));
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
            "cmb_id" => $this->id,
            "cmb_title" => $this->title,
            "cmb_price" => $this->price,
       );
       return $entity;
   }

}
