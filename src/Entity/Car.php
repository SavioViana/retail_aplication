<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
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
    private $model;

    
    
  
    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\Column(type="bigint")
     */
    private $year;


    /**
     * @ORM\OneToMany(targetEntity=Rentail::class, mappedBy="car")
     */
    private $rentails;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->rentails = new ArrayCollection();
    }

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

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }
    
    

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection|Rentail[]
     */
    public function getRentails(): Collection
    {
        return $this->rentails;
    }

    public function addRentail(Rentail $rentail): self
    {
        if (!$this->rentails->contains($rentail)) {
            $this->rentails[] = $rentail;
            $rentail->setCar($this);
        }

        return $this;
    }

    public function removeRentail(Rentail $rentail): self
    {
        if ($this->rentails->contains($rentail)) {
            $this->rentails->removeElement($rentail);
            // set the owning side to null (unless already changed)
            if ($rentail->getCar() === $this) {
                $rentail->setCar(null);
            }
        }

        return $this;
    }
}
