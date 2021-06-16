<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
{
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

    public function getTotalCommande(): ?string
    {
        return $this->total_commande;
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
}
