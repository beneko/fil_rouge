<?php

namespace App\Entity;

use App\Repository\AdresseLivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdresseLivraisonRepository::class)
 */
class AdresseLivraison
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
    private $ville_livr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_livraison;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_postal_livr;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateurs::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_pays;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleLivr(): ?string
    {
        return $this->ville_livr;
    }

    public function setVilleLivr(string $ville_livr): self
    {
        $this->ville_livr = $ville_livr;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresse_livraison;
    }

    public function setAdresseLivraison(string $adresse_livraison): self
    {
        $this->adresse_livraison = $adresse_livraison;

        return $this;
    }

    public function getCodePostalLivr(): ?string
    {
        return $this->code_postal_livr;
    }

    public function setCodePostalLivr(string $code_postal_livr): self
    {
        $this->code_postal_livr = $code_postal_livr;

        return $this;
    }

    public function getIdUtilisateur(): ?Utilisateurs
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?Utilisateurs $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getIdPays(): ?Pays
    {
        return $this->id_pays;
    }

    public function setIdPays(?Pays $id_pays): self
    {
        $this->id_pays = $id_pays;

        return $this;
    }
}
