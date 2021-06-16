<?php

namespace App\Entity;

use App\Repository\ModesLivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModesLivraisonRepository::class)
 */
class ModesLivraison
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
    private $nom_mode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle_liv;

    /**
     * @ORM\Column(type="integer")
     */
    private $delai_moy_liv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMode(): ?string
    {
        return $this->nom_mode;
    }

    public function setNomMode(string $nom_mode): self
    {
        $this->nom_mode = $nom_mode;

        return $this;
    }

    public function getLibelleLiv(): ?string
    {
        return $this->libelle_liv;
    }

    public function setLibelleLiv(string $libelle_liv): self
    {
        $this->libelle_liv = $libelle_liv;

        return $this;
    }

    public function getDelaiMoyLiv(): ?int
    {
        return $this->delai_moy_liv;
    }

    public function setDelaiMoyLiv(int $delai_moy_liv): self
    {
        $this->delai_moy_liv = $delai_moy_liv;

        return $this;
    }
}
