<?php

namespace App\Entity;

use App\Repository\CotisationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CotisationsRepository::class)]
class Cotisations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idPro = null;

    #[ORM\Column]
    private ?int $numappart = null;

    #[ORM\Column]
    private ?int $idCot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPro(): ?int
    {
        return $this->idPro;
    }

    public function setIdPro(int $idPro): static
    {
        $this->idPro = $idPro;

        return $this;
    }

    public function getNumappart(): ?int
    {
        return $this->numappart;
    }

    public function setNumappart(int $numappart): static
    {
        $this->numappart = $numappart;

        return $this;
    }

    public function getIdCot(): ?int
    {
        return $this->idCot;
    }

    public function setIdCot(int $idCot): static
    {
        $this->idCot = $idCot;

        return $this;
    }
}
