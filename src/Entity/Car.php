<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\NotBlank
     */
    private $model;

    
    
  
    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private $brand;

    /**
     * @ORM\Column(type="bigint")
     * @Assert\NotBlank
     */
    private $year;

     /**
     * @ORM\Column(type="boolean")
     */
    private $status;

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

    public function is_retail()
    {
        $carRepository = $this->getDoctrine()
        ->getRepository(self::class)->checkCarStatus($this->getId() );

        dd(carRepository());
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status = false ): self
    {
        $this->status = $status;

        return $this;
    }
    
}
