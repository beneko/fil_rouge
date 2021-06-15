<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reduction
 *
 * @ORM\Table(name="reduction")
 * @ORM\Entity
 */
class Reduction
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reduc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReduc;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_reduc", type="string", length=80, nullable=false)
     */
    private $nomReduc;

    /**
     * @var string
     *
     * @ORM\Column(name="montant_reduc", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $montantReduc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_reduc", type="string", length=50, nullable=false)
     */
    private $statutReduc;

    /**
     * @var int
     *
     * @ORM\Column(name="qte_reduction", type="integer", nullable=false)
     */
    private $qteReduction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Utilisateurs", mappedBy="idReduc")
     */
    private $idUtilisateur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUtilisateur = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdReduc(): ?int
    {
        return $this->idReduc;
    }

    public function getNomReduc(): ?string
    {
        return $this->nomReduc;
    }

    public function setNomReduc(string $nomReduc): self
    {
        $this->nomReduc = $nomReduc;

        return $this;
    }

    public function getMontantReduc(): ?string
    {
        return $this->montantReduc;
    }

    public function setMontantReduc(string $montantReduc): self
    {
        $this->montantReduc = $montantReduc;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getStatutReduc(): ?string
    {
        return $this->statutReduc;
    }

    public function setStatutReduc(string $statutReduc): self
    {
        $this->statutReduc = $statutReduc;

        return $this;
    }

    public function getQteReduction(): ?int
    {
        return $this->qteReduction;
    }

    public function setQteReduction(int $qteReduction): self
    {
        $this->qteReduction = $qteReduction;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection|Utilisateurs[]
     */
    public function getIdUtilisateur(): Collection
    {
        return $this->idUtilisateur;
    }

    public function addIdUtilisateur(Utilisateurs $idUtilisateur): self
    {
        if (!$this->idUtilisateur->contains($idUtilisateur)) {
            $this->idUtilisateur[] = $idUtilisateur;
            $idUtilisateur->addIdReduc($this);
        }

        return $this;
    }

    public function removeIdUtilisateur(Utilisateurs $idUtilisateur): self
    {
        if ($this->idUtilisateur->removeElement($idUtilisateur)) {
            $idUtilisateur->removeIdReduc($this);
        }

        return $this;
    }

}
