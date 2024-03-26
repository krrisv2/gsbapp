<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UtilisateursRepository::class)]
#[UniqueEntity(fields:["username"])]
class Utilisateurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $adresse = null;

    #[ORM\Column(length: 50)]
    private ?string $code_ville = null;

    #[ORM\Column(length: 50)]
    private ?string $telephone = null;

    #[ORM\Column(length: 50)]
    private ?string $motdepasse = null;

    #[ORM\Column(length: 50)]
    private ?string $username = null;
    
    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 1)]
    private ?int $type = null;

    #[ORM\OneToOne(mappedBy: 'idUtil', cascade: ['persist', 'remove'])]
    private ?Proprietaires $proprietaires = null;

    #[ORM\OneToOne(mappedBy: 'idUtil', cascade: ['persist', 'remove'])]
    private ?Locataires $locataires = null;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodeVille(): ?string
    {
        return $this->code_ville;
    }

    public function setCodeVille(string $code_ville): static
    {
        $this->code_ville = $code_ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMotdepasse():?string{
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): static{
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getUsername():?string{
        return $this->username;
    }
    public function setUsername(string $username): static{
        $this->username = $username;

        return $this;
    }

    public function getEmail():?string{
        return $this->email;
    }

    public function setEmail(string $email): static{
        $this->email = $email;

        return $this;
    }

    public function getType():?int{
        return $this->type;
    }

    public function setType(int $type): static{
        $this->type = $type;

        return $this;
    }

    public function getProprietaires(): ?Proprietaires
    {
        return $this->proprietaires;
    }

    public function setProprietaires(Proprietaires $proprietaires): static
    {
        // set the owning side of the relation if necessary
        if ($proprietaires->getIdUtil() !== $this) {
            $proprietaires->setIdUtil($this);
        }

        $this->proprietaires = $proprietaires;

        return $this;
    }

    public function getLocataires(): ?Locataires
    {
        return $this->locataires;
    }

    public function setLocataires(Locataires $locataires): static
    {
        // set the owning side of the relation if necessary
        if ($locataires->getIdUtil() !== $this) {
            $locataires->setIdUtil($this);
        }

        $this->locataires = $locataires;

        return $this;
    }
}
