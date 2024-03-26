<?php

namespace App\Entity;

use App\Repository\AppartementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppartementsRepository::class)]
class Appartements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numappart = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $typappart = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 17, scale: 2, nullable: true)]
    private ?string $loyer = null;

    #[ORM\Column(nullable: true)]
    private ?int $etage = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ascenceur = null;

    #[ORM\Column(nullable: true)]
    private ?bool $preavis = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_libre = null;

    #[ORM\Column(length: 50)]
    private ?string $rue = null;

    #[ORM\Column(length: 50)]
    private ?string $codeville = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $arrondissement = null;

    #[ORM\ManyToOne(inversedBy: 'appartements',  cascade: ['remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Proprietaires $idPro = null;

    #[ORM\OneToOne(inversedBy: 'appartements', cascade: ['remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Locataires $idLoc = null;

    #[ORM\OneToMany(targetEntity: Visiter::class, mappedBy: 'numappart')]
    private Collection $visiters;

    public function __construct()
    {
        $this->visiters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypappart(): ?string
    {
        return $this->typappart;
    }

    public function setTypappart(?string $typappart): static
    {
        $this->typappart = $typappart;

        return $this;
    }

    public function getLoyer(): ?string
    {
        return $this->loyer;
    }

    public function setLoyer(?string $loyer): static
    {
        $this->loyer = $loyer;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(?int $etage): static
    {
        $this->etage = $etage;

        return $this;
    }

    public function isAscenceur(): ?bool
    {
        return $this->ascenceur;
    }

    public function setAscenceur(?bool $ascenceur): static
    {
        $this->ascenceur = $ascenceur;

        return $this;
    }

    public function isPreavis(): ?bool
    {
        return $this->preavis;
    }

    public function setPreavis(?bool $preavis): static
    {
        $this->preavis = $preavis;

        return $this;
    }

    public function getDateLibre(): ?\DateTimeInterface
    {
        return $this->date_libre;
    }

    public function setDateLibre(?\DateTimeInterface $date_libre): static
    {
        $this->date_libre = $date_libre;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCodeville(): ?string
    {
        return $this->codeville;
    }

    public function setCodeville(string $codeville): static
    {
        $this->codeville = $codeville;

        return $this;
    }

    public function getArrondissement(): ?string
    {
        return $this->arrondissement;
    }

    public function setArrondissement(?string $arrondissement): static
    {
        $this->arrondissement = $arrondissement;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        $string = '%1$s dans le %2$s à %3$s';

        return sprintf($string, $this->rue,$this->arrondissement,$this->codeville);
    }

    public function update(Appartements $updatedAppart){
        foreach ($updatedAppart as $key => $value){
            if($value == null){continue;}

            $this->$key = $value;
        }
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

    public function getIdLoc(): ?Locataires
    {
        return $this->idLoc;
    }

    public function setIdLoc(?Locataires $idLoc): static
    {
        $this->idLoc = $idLoc;

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
            $visiter->setNumappart($this);
        }

        return $this;
    }

    public function removeVisiter(Visiter $visiter): static
    {
        if ($this->visiters->removeElement($visiter)) {
            // set the owning side to null (unless already changed)
            if ($visiter->getNumappart() === $this) {
                $visiter->setNumappart(null);
            }
        }

        return $this;
    }
}
