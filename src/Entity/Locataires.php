<?php

namespace App\Entity;

use App\Repository\LocatairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocatairesRepository::class)]
class Locataires
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $rib = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $banque = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datenaiss = null;

    #[ORM\OneToOne(inversedBy: 'locataires', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateurs $idUtil = null;

    #[ORM\OneToOne(mappedBy: 'idLoc', cascade: ['persist', 'remove'])]
    private ?Appartements $appartements = null;

    #[ORM\OneToMany(targetEntity: Visiter::class, mappedBy: 'idDem')]
    private Collection $visiters;

    public function __construct()
    {
        $this->visiters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRib(): ?string
    {
        return $this->rib;
    }

    public function setRib(?string $rib): static
    {
        $this->rib = $rib;

        return $this;
    }

    public function getDatenaiss(): ?\DateTimeInterface
    {
        return $this->datenaiss;
    }

    public function setDatenaiss(\DateTimeInterface $datenaiss): static
    {
        $this->datenaiss = $datenaiss;

        return $this;
    }

    public function getBanque(): ?string
    {
        return $this->banque;
    }

    public function setBanque(string $banque):static {
        $this->banque = $banque; 

        return $this;
    }

    public function update(Locataires $updatedLocataire){
        foreach ($updatedLocataire as $key => $value){
            if($value == null){continue;}

            $this->$key = $value;
        }
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

    public function getAppartements(): ?Appartements
    {
        return $this->appartements;
    }

    public function setAppartements(?Appartements $appartements): static
    {
        // unset the owning side of the relation if necessary
        if ($appartements === null && $this->appartements !== null) {
            $this->appartements->setIdLoc(null);
        }

        // set the owning side of the relation if necessary
        if ($appartements !== null && $appartements->getIdLoc() !== $this) {
            $appartements->setIdLoc($this);
        }

        $this->appartements = $appartements;

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
            $visiter->setIdDem($this);
        }

        return $this;
    }

    public function removeVisiter(Visiter $visiter): static
    {
        if ($this->visiters->removeElement($visiter)) {
            // set the owning side to null (unless already changed)
            if ($visiter->getIdDem() === $this) {
                $visiter->setIdDem(null);
            }
        }

        return $this;
    }
}
