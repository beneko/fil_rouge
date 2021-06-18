<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id" , type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="nom_pays" , type="string", length=255)
     */
    private $nom_pays;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPays(): ?string
    {
        return $this->nom_pays;
    }

    public function setNomPays($nom_pays): self
    {
        $this->nom_pays = $nom_pays;
        return $this;
    }


    public function __toString():string{
        return $this->nom_pays;
    }
}
