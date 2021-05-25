<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeRepository::class)
 */
class Liste
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="listes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="listes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $livre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): self
    {
        $this->livre = $livre;

        return $this;
    }
}
