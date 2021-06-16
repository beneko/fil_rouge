<?php

namespace App\Entity;

use App\Repository\PaysRepository;
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

    public function getNomPays(): ?string
    {
        return $this->nom_pays;
    }

    public function setNomPays(string $nom_pays): self
    {
        $this->nom_pays = $nom_pays;

        return $this;
    }

    public function __tostring():string{
        return $this->nom_pays;
    }



}
