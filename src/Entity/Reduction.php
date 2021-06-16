<?php

namespace App\Entity;

use App\Repository\ReductionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReductionRepository::class)
 */
class Reduction
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
    private $nom_reduc;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $montant_reduc;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="integer")
     */
    private $qte_reduction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut_reduc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomReduc(): ?string
    {
        return $this->nom_reduc;
    }

    public function setNomReduc(string $nom_reduc): self
    {
        $this->nom_reduc = $nom_reduc;

        return $this;
    }

    public function getMontantReduc(): ?string
    {
        return $this->montant_reduc;
    }

    public function setMontantReduc(string $montant_reduc): self
    {
        $this->montant_reduc = $montant_reduc;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getQteReduction(): ?int
    {
        return $this->qte_reduction;
    }

    public function setQteReduction(int $qte_reduction): self
    {
        $this->qte_reduction = $qte_reduction;

        return $this;
    }

    public function getStatutReduc(): ?string
    {
        return $this->statut_reduc;
    }

    public function setStatutReduc(string $statut_reduc): self
    {
        $this->statut_reduc = $statut_reduc;

        return $this;
    }
}
