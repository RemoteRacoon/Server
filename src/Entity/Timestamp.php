<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait Timestamp 
{
  /**
   * @ORM\Column(type="datetime")
   */
  private $createdAt;

  /**
   * @ORM\Column(type="datetime")
   */
  private $updatedAt;

  /**
   * @ORM\PrePersist()
   */
  public function createdAt()
  {
      $this->createdAt = new DateTime();
      $this->updatedAt = new DateTime();
  }

  /**
   * @ORM\PreUpdate()
   */
  public function updatedAt()
  {
      $this->updatedAt = new DateTime();
  }


  public function getCreatedAt() : DateTime
  {
    return $this->createdAt;
  }

}