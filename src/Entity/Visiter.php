<?php

namespace App\Entity;

use App\Repository\VisiterRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisiterRepository::class)]
class Visiter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private DateTimeInterface|string $DATE_VISITE = "";

    #[ORM\ManyToOne(inversedBy: 'visiters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Proprietaires $idPro = null;

    #[ORM\ManyToOne(inversedBy: 'visiters',cascade: ['remove'])]
    #[ORM\JoinColumn(nullable: false,)]
    private ?Locataires $idDem = null;

    #[ORM\ManyToOne(inversedBy: 'visiters', cascade: ['remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Appartements $numappart = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDATEVISITE(): DateTimeInterface | string
    {
        return $this->DATE_VISITE;
    }

    public function setDATEVISITE(DateTimeInterface | string $DATE_VISITE): static
    {
        $this->DATE_VISITE = $DATE_VISITE;

        return $this;
    }

    public function getIdPro(): ?Proprietaires
    {
        return $this->idPro;
    }

    public function setIdPro(?Proprietaires $idPro): static
    {
        $this->idPro = $idPro;

        return $this;
    }

    public function getIdDem(): ?Locataires
    {
        return $this->idDem;
    }

    public function setIdDem(?Locataires $idDem): static
    {
        $this->idDem = $idDem;

        return $this;
    }

    public function getNumappart(): ?Appartements
    {
        return $this->numappart;
    }

    public function setNumappart(?Appartements $numappart): static
    {
        $this->numappart = $numappart;

        return $this;
    }
}
