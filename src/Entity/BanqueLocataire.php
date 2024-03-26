<?php

namespace App\Entity;

use App\Repository\BanqueLocataireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BanqueLocataireRepository::class)]
class BanqueLocataire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomBanque = null;

    #[ORM\Column(length: 50)]
    private ?string $numCompte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomBanque(): ?string
    {
        return $this->nomBanque;
    }

    public function setNomBanque(string $nomBanque): static
    {
        $this->nomBanque = $nomBanque;

        return $this;
    }

    public function getNumCompte(): ?string
    {
        return $this->numCompte;
    }

    public function setNumCompte(string $numCompte): static
    {
        $this->numCompte = $numCompte;

        return $this;
    }
}
