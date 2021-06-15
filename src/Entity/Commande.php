<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="id_mode_liv", columns={"id_mode_liv"}), @ORM\Index(name="id_reduc", columns={"id_reduc"}), @ORM\Index(name="id_adrr_livr", columns={"id_adrr_livr"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_commande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_com", type="date", nullable=false)
     */
    private $dateCom;

    /**
     * @var string
     *
     * @ORM\Column(name="total_commande", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $totalCommande;

    /**
     * @var \AdresseDeLivraison
     *
     * @ORM\ManyToOne(targetEntity="AdresseDeLivraison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_adrr_livr", referencedColumnName="id_adrr_livr")
     * })
     */
    private $idAdrrLivr;

    /**
     * @var \ModesLivraison
     *
     * @ORM\ManyToOne(targetEntity="ModesLivraison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mode_liv", referencedColumnName="id_mode_liv")
     * })
     */
    private $idModeLiv;

    /**
     * @var \Reduction
     *
     * @ORM\ManyToOne(targetEntity="Reduction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reduc", referencedColumnName="id_reduc")
     * })
     */
    private $idReduc;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="idCommande")
     */
    private $idProduit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCommande(): ?int
    {
        return $this->idCommande;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->dateCom;
    }

    public function setDateCom(\DateTimeInterface $dateCom): self
    {
        $this->dateCom = $dateCom;

        return $this;
    }

    public function getTotalCommande(): ?string
    {
        return $this->totalCommande;
    }

    public function setTotalCommande(string $totalCommande): self
    {
        $this->totalCommande = $totalCommande;

        return $this;
    }

    public function getIdAdrrLivr(): ?AdresseDeLivraison
    {
        return $this->idAdrrLivr;
    }

    public function setIdAdrrLivr(?AdresseDeLivraison $idAdrrLivr): self
    {
        $this->idAdrrLivr = $idAdrrLivr;

        return $this;
    }

    public function getIdModeLiv(): ?ModesLivraison
    {
        return $this->idModeLiv;
    }

    public function setIdModeLiv(?ModesLivraison $idModeLiv): self
    {
        $this->idModeLiv = $idModeLiv;

        return $this;
    }

    public function getIdReduc(): ?Reduction
    {
        return $this->idReduc;
    }

    public function setIdReduc(?Reduction $idReduc): self
    {
        $this->idReduc = $idReduc;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getIdProduit(): Collection
    {
        return $this->idProduit;
    }

    public function addIdProduit(Produit $idProduit): self
    {
        if (!$this->idProduit->contains($idProduit)) {
            $this->idProduit[] = $idProduit;
            $idProduit->addIdCommande($this);
        }

        return $this;
    }

    public function removeIdProduit(Produit $idProduit): self
    {
        if ($this->idProduit->removeElement($idProduit)) {
            $idProduit->removeIdCommande($this);
        }

        return $this;
    }

}
