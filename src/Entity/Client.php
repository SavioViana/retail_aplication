<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email(
     *    message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $birth;

    /**
     * @ORM\Column(type="string", length=11)
     * @Assert\NotBlank
     */
    private $cpf;


    /**
     * @ORM\OneToMany(targetEntity=Rentail::class, mappedBy="client")
     */
    private $rentails;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(\DateTimeInterface $birth): self
    {
        $this->birth = $birth;

        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

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
            $rentail->setClient($this);
        }

        return $this;
    }

    public function removeRentail(Rentail $rentail): self
    {
        if ($this->rentails->contains($rentail)) {
            $this->rentails->removeElement($rentail);
            // set the owning side to null (unless already changed)
            if ($rentail->getClient() === $this) {
                $rentail->setClient(null);
            }
        }

        return $this;
    }
}
