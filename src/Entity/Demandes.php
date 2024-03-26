<?php

namespace App\Entity;

use App\Repository\DemandesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandesRepository::class)]
class Demandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $num_dem = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $type_dem = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_limite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumDem(): ?int
    {
        return $this->num_dem;
    }

    public function setNumDem(int $num_dem): static
    {
        $this->num_dem = $num_dem;

        return $this;
    }

    public function getTypeDem(): ?string
    {
        return $this->type_dem;
    }

    public function setTypeDem(?string $type_dem): static
    {
        $this->type_dem = $type_dem;

        return $this;
    }

    public function getDateLimite(): ?\DateTimeInterface
    {
        return $this->date_limite;
    }

    public function setDateLimite(\DateTimeInterface $date_limite): static
    {
        $this->date_limite = $date_limite;

        return $this;
    }
}
