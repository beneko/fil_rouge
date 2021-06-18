<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
{


    // ...

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut = self::STATUT_PANIER;

    /**
     * An order that is in progress, not placed yet.
     *
     * @var string
     */
    const STATUT_PANIER = 'panier';




    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_com;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $total_commande;

    /**
     * @ORM\ManyToOne(targetEntity=AdresseLivraison::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_addr_livr;

    /**
     * @ORM\ManyToOne(targetEntity=ModesLivraison::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_mode_livr;

    /**
     * @ORM\ManyToOne(targetEntity=Reduction::class)
     */
    private $id_reduc;

    /**
     * @ORM\OneToMany(targetEntity=LigCom::class, mappedBy="refCommande", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $contenu_panier;
//objetspanier
    /**
     * @var array
     */
    private $objet;

    public function __construct()
    {
        $this->contenu_panier = new ArrayCollection();
    }


    /**
     * @return array
     */
    public function getObjet(): array
    {
        return $this->objet;
    }


    /**
     * @param array $objet
     */
    public function setObjet(array $objet): void
    {
        $this->objet = $objet;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->date_com;
    }

    public function setDateCom(\DateTimeInterface $date_com): self
    {
        $this->date_com = $date_com;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatut(): string
    {
        return $this->statut;
    }


    /**
     * @param string $statut
     */
    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
    }




    public function getTotalCommande(): float
    {
//        return $this->total_commande;
        $total = 0;

        foreach ($this->getContenuPanier() as $item) {
            $total += $item->getComSousTot();
        }

        return $total;

    }

    public function setTotalCommande(string $total_commande): self
    {
        $this->total_commande = $total_commande;

        return $this;
    }

    public function getIdAddrLivr(): ?AdresseLivraison
    {
        return $this->id_addr_livr;
    }

    public function setIdAddrLivr(?AdresseLivraison $id_addr_livr): self
    {
        $this->id_addr_livr = $id_addr_livr;

        return $this;
    }

    public function getIdModeLivr(): ?ModesLivraison
    {
        return $this->id_mode_livr;
    }

    public function setIdModeLivr(?ModesLivraison $id_mode_livr): self
    {
        $this->id_mode_livr = $id_mode_livr;

        return $this;
    }

    public function getIdReduc(): ?Reduction
    {
        return $this->id_reduc;
    }

    public function setIdReduc(?Reduction $id_reduc): self
    {
        $this->id_reduc = $id_reduc;

        return $this;
    }


    /**
     * @return Collection|LigCom[]
     */
    public function getContenuPanier(): Collection
    {
        return $this->contenu_panier;
    }

    public function addContenuPanier(LigCom $objet): self
    {
//        if (!$this->contenu_panier->contains($contenuPanier)) {
//            $this->contenu_panier[] = $contenuPanier;
//            $contenuPanier->setRefCommande($this);
//        }
//
//        return $this;



        foreach ($this->getContenuPanier() as $existingItem) {
            // The item already exists, update the quantity
            if ($existingItem->equals($objet)) {
                $existingItem->setQteProduit(
                    $existingItem->getQteProduit() + $objet->getQteProduit()
                );
                return $this;
            }
        }

        $this->objet[] = $objet;
        $objet->setRefCommande($this);

        return $this;

    }

    public function removeContenuPanier(LigCom $contenuPanier): self
    {
//        if ($this->contenu_panier->removeElement($contenuPanier)) {
//            // set the owning side to null (unless already changed)
//            if ($contenuPanier->getRefCommande() === $this) {
//                $contenuPanier->setRefCommande(null);
//            }
//        }
//
//        return $this;


        foreach ($this->getContenuPanier() as $item) {
            $this->removeContenuPanier($item);
        }
        return $this;

    }




}
