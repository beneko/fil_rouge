<?php

namespace App\Entity;

use App\Repository\RolesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass=RolesRepository::class)
 */
class Roles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id" , type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="nom_role" , type="string", length=255)
     */
    private $nom_role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRole(): ?string
    {
        return $this->nom_role;
    }
    public function setNomRole(?string $nom_role): self
    {
        $this->nom_role = $nom_role;
        return $this;
    }

    public function __toString(): string
    {
        return $this->nom_role;
    }




}
