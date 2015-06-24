<?php
/**
 * Entity Phinxlog
 * Auto Generate :2015-06-25 00:37:15
 * phinxlog
 */
namespace buvette\Entity\Generated;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;


class Phinxlog implements Entity
{

   /**
    * @var bigint
    */
   private $version = null;

   /**
    * @var timestamp
    */
   private $startTime = null;

   /**
    * @var timestamp
    */
   private $time = null;

   /**
    * @param ClassMetadata $metadata
    */
    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
            $metadata->addPropertyConstraint("version", new Assert\Length(array("max" => 20, "maxMessage" => "trop long")));
            $metadata->addPropertyConstraint("version", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("startTime", new Assert\NotBlank(array("message" => "Not null")));
            $metadata->addPropertyConstraint("time", new Assert\NotBlank(array("message" => "Not null")));
    }

   /**
    * @return bigint
    */
   public function getVersion()
   {
       return $this->version;
   }

   /**
    * @param bigint $version
    */
   public function setVersion($version)
   {
       $this->version = $version;
   }

   /**
    * @return timestamp
    */
   public function getStartTime()
   {
       return $this->startTime;
   }

   /**
    * @param timestamp $startTime
    */
   public function setStartTime($startTime)
   {
       $this->startTime = $startTime;
   }

   /**
    * @return timestamp
    */
   public function getTime()
   {
       return $this->time;
   }

   /**
    * @param timestamp $time
    */
   public function setTime($time)
   {
       $this->time = $time;
   }

   /**
    * @return array Entity 
    */
   public function getArray()
   {
       $entity = array(
            "version" => $this->version,
            "start_time" => $this->startTime,
            "end_time" => $this->time,
       );
       return $entity;
   }

}
