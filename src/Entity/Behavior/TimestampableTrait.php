<?php

namespace App\Entity\Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\HasLifecycleCallbacks()
 */
trait TimestampableTrait {

  /**
    * @ORM\PreUpdate
    */
    public function setUpdateAtValue()
    {
      $this->updatedAt = new \DateTime();
    }

    /**
      * @ORM\PrePersist
      */
      public function setCreatedAtValue()
      {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
      }

}
