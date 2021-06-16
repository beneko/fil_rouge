<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
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
    private $nom_produit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle_produit;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prix_produit;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock_produit;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $pds_produit;

    /**
     * @ORM\ManyToOne(targetEntity=Marques::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_marque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class)
     */
    private $categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nom_produit;
    }

    public function setNomProduit(string $nom_produit): self
    {
        $this->nom_produit = $nom_produit;

        return $this;
    }

    public function getLibelleProduit(): ?string
    {
        return $this->libelle_produit;
    }

    public function setLibelleProduit(?string $libelle_produit): self
    {
        $this->libelle_produit = $libelle_produit;

        return $this;
    }

    public function getPrixProduit(): ?string
    {
        return $this->prix_produit;
    }

    public function setPrixProduit(string $prix_produit): self
    {
        $this->prix_produit = $prix_produit;

        return $this;
    }

    public function getStockProduit(): ?int
    {
        return $this->stock_produit;
    }

    public function setStockProduit(int $stock_produit): self
    {
        $this->stock_produit = $stock_produit;

        return $this;
    }

    public function getPdsProduit(): ?string
    {
        return $this->pds_produit;
    }

    public function setPdsProduit(string $pds_produit): self
    {
        $this->pds_produit = $pds_produit;

        return $this;
    }

    public function getIdMarque(): ?Marques
    {
        return $this->id_marque;
    }

    public function setIdMarque(?Marques $id_marque): self
    {
        $this->id_marque = $id_marque;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
