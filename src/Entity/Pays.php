<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
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
    private $nom_pays;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function __tostring():string{
        return $this->nom_pays;
    }

    /**
     * @return Collection|Utilisateurs[]
     */
    public function getNomPays(): Collection
    {
        return $this->nom_pays;
    }

    public function addNomPays(Utilisateurs $nom_pays): self
    {
        if (!$this->nom_pays->contains($nom_pays)) {
            $this->$nom_pays[] = $nom_pays;
            $nom_pays->setIdPays($this);
        }

        return $this;
    }

    public function removeNomPays(Utilisateurs $nom_pays): self
    {
        if ($this->nom_pays->removeElement($nom_pays)) {
            // set the owning side to null (unless already changed)
            if ($nom_pays->getIdPays() === $this) {
                $nom_pays->setIdPays(null);
            }
        }

        return $this;
    }
}
