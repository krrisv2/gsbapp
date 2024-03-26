<?php

namespace App\Entity;

use App\Repository\ProprietairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProprietairesRepository::class)]
class Proprietaires 
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'proprietaires', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateurs $idUtil = null;

    #[ORM\OneToMany(targetEntity: Appartements::class, mappedBy: 'idPro', cascade:['persist', 'remove'], orphanRemoval: true)]
    private Collection $appartements;

    #[ORM\OneToMany(targetEntity: Visiter::class, mappedBy: 'idPro')]
    private Collection $visiters;

    public function __construct()
    {
        $this->appartements = new ArrayCollection();
        $this->visiters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtil(): ?Utilisateurs
    {
        return $this->idUtil;
    }

    public function setIdUtil(Utilisateurs $idUtil): static
    {
        $this->idUtil = $idUtil;

        return $this;
    }

    /**
     * @return Collection<int, Appartements>
     */
    public function getAppartements(): Collection
    {
        return $this->appartements;
    }

    public function addAppartement(Appartements $appartement): static
    {
        $array =  $this->appartements->toArray();
        if (!in_array($appartement,$array)) {
            print_r($appartement);
            $this->appartements->add($appartement);
            $appartement->setIdPro($this);
        }

        return $this;
    }

    public function removeAppartement(Appartements $appartement): static
    {
        if ($this->appartements->removeElement($appartement)) {
            // set the owning side to null (unless already changed)
            if ($appartement->getIdPro() === $this) {
                $appartement->setIdPro(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Visiter>
     */
    public function getVisiters(): Collection
    {
        return $this->visiters;
    }

    public function addVisiter(Visiter $visiter): static
    {
        if (!$this->visiters->contains($visiter)) {
            $this->visiters->add($visiter);
            $visiter->setIdPro($this);
        }

        return $this;
    }

    public function removeVisiter(Visiter $visiter): static
    {
        if ($this->visiters->removeElement($visiter)) {
            // set the owning side to null (unless already changed)
            if ($visiter->getIdPro() === $this) {
                $visiter->setIdPro(null);
            }
        }

        return $this;
    }
}
