<?php

namespace App\Entity;

use App\Repository\DemandeursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeursRepository::class)]
class Demandeurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idUtil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtil(): ?int
    {
        return $this->idUtil;
    }

    public function setIdUtil(int $idUtil): static
    {
        $this->idUtil = $idUtil;

        return $this;
    }
}
