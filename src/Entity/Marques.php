<?php

namespace App\Entity;

use App\Repository\MarquesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarquesRepository::class)
 */
class Marques
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_marque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle_marque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo_marque;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMarque()
    {
        return $this->nom_marque;
    }

    public function setNomMarque(string $nom_marque): self
    {
        $this->nom_marque = $nom_marque;

        return $this;
    }

    public function getLibelleMarque(): ?string
    {
        return $this->libelle_marque;
    }

    public function setLibelleMarque(?string $libelle_marque): self
    {
        $this->libelle_marque = $libelle_marque;

        return $this;
    }

    public function getLogoMarque(): ?string
    {
        return $this->logo_marque;
    }

    public function setLogoMarque(?string $logo_marque): self
    {
        $this->logo_marque = $logo_marque;

        return $this;
    }


    public function __tostring():string{
        return $this->nom_marque;
    }


}
