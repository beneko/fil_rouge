<?php

namespace App\Entity;

use App\Repository\LigComRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigComRepository::class)
 */
class LigCom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Produits::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_produit;


    /**
     * @ORM\Column(type="integer")
     */
    private $qte_produit;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $remise;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $com_sous_tot;

    /**
     * @ORM\ManyToOne(targetEntity=Commandes::class, inversedBy="contenu_panier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $refCommande;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?Produits
    {
        return $this->id_produit;
    }

    public function setIdProduit(?Produits $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }


    public function getQteProduit(): ?int
    {
        return $this->qte_produit;
    }

    public function setQteProduit(int $qte_produit): self
    {
        $this->qte_produit = $qte_produit;

        return $this;
    }

    public function getRemise(): ?string
    {
        return $this->remise;
    }

    public function setRemise(string $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getComSousTot(): ?string
    {
//        return $this->com_sous_tot;
        return $this->getIdProduit()->getPrixProduit() * $this->getQteProduit();

    }

    public function setComSousTot(string $com_sous_tot): self
    {
        $this->com_sous_tot = $com_sous_tot;

        return $this;
    }


    public function getRefCommande(): ?Commandes
    {
        return $this->refCommande;
    }

    public function setRefCommande(?Commandes $refCommande): self
    {
        $this->refCommande = $refCommande;

        return $this;
    }


    /**
     * Tests if the given item given corresponds to the same order item.
     *
     * @param LigCom $objet
     *
     * @return bool
     */
    public function equals(LigCom $objet): bool
    {
        return $this->getIdProduit()->getId() === $objet->getIdProduit()->getId();
    }





}
