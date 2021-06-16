<?php

namespace App\Entity;

use App\Repository\ReducPasseeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReducPasseeRepository::class)
 */
class ReducPassee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Utilisateurs::class)
     */
    private $id_utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Reduction::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_reduc;

    public function __construct()
    {
        $this->id_utilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Utilisateurs[]
     */
    public function getIdUtilisateur(): Collection
    {
        return $this->id_utilisateur;
    }

    public function addIdUtilisateur(Utilisateurs $idUtilisateur): self
    {
        if (!$this->id_utilisateur->contains($idUtilisateur)) {
            $this->id_utilisateur[] = $idUtilisateur;
        }

        return $this;
    }

    public function removeIdUtilisateur(Utilisateurs $idUtilisateur): self
    {
        $this->id_utilisateur->removeElement($idUtilisateur);

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
