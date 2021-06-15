<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="id_marque", columns={"id_marque"}), @ORM\Index(name="id_cat", columns={"id_cat"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_produit", type="string", length=50, nullable=false)
     */
    private $nomProduit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle_produit", type="string", length=100, nullable=true)
     */
    private $libelleProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="prix_produit", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $prixProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="stock_produit", type="integer", nullable=false)
     */
    private $stockProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="taux_tva", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $tauxTva;

    /**
     * @var string
     *
     * @ORM\Column(name="pds_produit", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $pdsProduit;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=true)
     */
    private $image;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cat", referencedColumnName="id_cat")
     * })
     */
    private $idCat;

    /**
     * @var \Marques
     *
     * @ORM\ManyToOne(targetEntity="Marques")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_marque", referencedColumnName="id_marque")
     * })
     */
    private $idMarque;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Commande", inversedBy="idProduit")
     * @ORM\JoinTable(name="ligcom",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_produit", referencedColumnName="id_produit")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_commande", referencedColumnName="id_commande")
     *   }
     * )
     */
    private $idCommande;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCommande = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdProduit(): ?int
    {
        return $this->idProduit;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getLibelleProduit(): ?string
    {
        return $this->libelleProduit;
    }

    public function setLibelleProduit(?string $libelleProduit): self
    {
        $this->libelleProduit = $libelleProduit;

        return $this;
    }

    public function getPrixProduit(): ?string
    {
        return $this->prixProduit;
    }

    public function setPrixProduit(string $prixProduit): self
    {
        $this->prixProduit = $prixProduit;

        return $this;
    }

    public function getStockProduit(): ?int
    {
        return $this->stockProduit;
    }

    public function setStockProduit(int $stockProduit): self
    {
        $this->stockProduit = $stockProduit;

        return $this;
    }

    public function getTauxTva(): ?string
    {
        return $this->tauxTva;
    }

    public function setTauxTva(string $tauxTva): self
    {
        $this->tauxTva = $tauxTva;

        return $this;
    }

    public function getPdsProduit(): ?string
    {
        return $this->pdsProduit;
    }

    public function setPdsProduit(string $pdsProduit): self
    {
        $this->pdsProduit = $pdsProduit;

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

    public function getIdCat(): ?Categorie
    {
        return $this->idCat;
    }

    public function setIdCat(?Categorie $idCat): self
    {
        $this->idCat = $idCat;

        return $this;
    }

    public function getIdMarque(): ?Marques
    {
        return $this->idMarque;
    }

    public function setIdMarque(?Marques $idMarque): self
    {
        $this->idMarque = $idMarque;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getIdCommande(): Collection
    {
        return $this->idCommande;
    }

    public function addIdCommande(Commande $idCommande): self
    {
        if (!$this->idCommande->contains($idCommande)) {
            $this->idCommande[] = $idCommande;
        }

        return $this;
    }

    public function removeIdCommande(Commande $idCommande): self
    {
        $this->idCommande->removeElement($idCommande);

        return $this;
    }

}
