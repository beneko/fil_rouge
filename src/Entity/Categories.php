<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
    private $nom_cat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle_cat;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class)
     */
    private $id_cat;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $image_cat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCat(): ?string
    {
        return $this->nom_cat;
    }

    public function setNomCat(string $nom_cat): self
    {
        $this->nom_cat = $nom_cat;

        return $this;
    }

    public function getLibelleCat(): ?string
    {
        return $this->libelle_cat;
    }

    public function setLibelleCat(?string $libelle_cat): self
    {
        $this->libelle_cat = $libelle_cat;

        return $this;
    }

    public function getIdCat(): ?self
    {
        return $this->id_cat;
    }

    public function setIdCat(?self $id_cat): self
    {
        $this->id_cat = $id_cat;

        return $this;
    }

    public function __tostring():string{
        return $this->nom_cat;
    }

    public function getImageCat(): ?string
    {
        return $this->image_cat;
    }

    public function setImageCat(?string $image_cat): self
    {
        $this->image_cat = $image_cat;

        return $this;
    }



}
