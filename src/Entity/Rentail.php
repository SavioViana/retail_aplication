<?php

namespace App\Entity;

use App\Repository\RentailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentailRepository::class)
 */
class Rentail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Car::class, inversedBy="rentails")
     */
    private $car;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="rentails")
     */
    private $client;



    /**
     * @ORM\Column(type="datetime")
     */
    private $date_rentail;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_devolution;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getDateRentail(): ?\DateTimeInterface
    {
        return $this->date_rentail;
    }

    public function setDateRentail(\DateTimeInterface $date_rentail): self
    {
        $this->date_rentail = $date_rentail;

        return $this;
    }

    public function getDateDevolution(): ?\DateTimeInterface
    {
        return $this->date_devolution;
    }

    public function setDateDevolution(?\DateTimeInterface $date_devolution): self
    {
        $this->date_devolution = $date_devolution;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

}