<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 */
class Profile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $second_name;

    /**
     * @ORM\ManyToOne(targetEntity=Sex::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $sex;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=RelationshipStatus::class)
     */
    private $relationship_status;

    /**
     * @ORM\ManyToOne(targetEntity=EducationStatus::class)
     */
    private $education_status;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="profiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $about;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birth_date;

    /**
     * @ORM\ManyToOne(targetEntity=EducationCenter::class, inversedBy="profiles")
     */
    private $education_center;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSecondName(): ?string
    {
        return $this->second_name;
    }

    public function setSecondName(string $second_name): self
    {
        $this->second_name = $second_name;

        return $this;
    }

    public function getSex(): ?Sex
    {
        return $this->sex;
    }

    public function setSex(Sex $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getRelationshipStatus(): ?RelationshipStatus
    {
        return $this->relationship_status;
    }

    public function setRelationshipStatus(?RelationshipStatus $relationship_status): self
    {
        $this->relationship_status = $relationship_status;

        return $this;
    }

    public function getEducationStatus(): ?EducationStatus
    {
        return $this->education_status;
    }

    public function setEducationStatus(?EducationStatus $education_status): self
    {
        $this->education_status = $education_status;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getEducationCenter(): ?EducationCenter
    {
        return $this->education_center;
    }

    public function setEducationCenter(?EducationCenter $education_center): self
    {
        $this->education_center = $education_center;

        return $this;
    }
}
