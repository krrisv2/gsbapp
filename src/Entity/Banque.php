<?php

namespace App\Entity;

use App\Repository\BanqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BanqueRepository::class)]
class Banque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomBanque = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $rueBanque = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $codevilleBanque = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $telbanque = null;

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

    public function getRueBanque(): ?string
    {
        return $this->rueBanque;
    }

    public function setRueBanque(?string $rueBanque): static
    {
        $this->rueBanque = $rueBanque;

        return $this;
    }

    public function getCodevilleBanque(): ?string
    {
        return $this->codevilleBanque;
    }

    public function setCodevilleBanque(?string $codevilleBanque): static
    {
        $this->codevilleBanque = $codevilleBanque;

        return $this;
    }

    public function getTelbanque(): ?string
    {
        return $this->telbanque;
    }

    public function setTelbanque(?string $telbanque): static
    {
        $this->telbanque = $telbanque;

        return $this;
    }
}
