<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie", uniqueConstraints={@ORM\UniqueConstraint(name="nom_cat", columns={"nom_cat"})}, indexes={@ORM\Index(name="id_cat_1", columns={"id_cat_1"})})
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_cat", type="string", length=50, nullable=false)
     */
    private $nomCat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle_cat", type="string", length=100, nullable=true)
     */
    private $libelleCat;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cat_1", referencedColumnName="id_cat")
     * })
     */
    private $idCat1;

    public function getIdCat(): ?int
    {
        return $this->idCat;
    }

    public function getNomCat(): ?string
    {
        return $this->nomCat;
    }

    public function setNomCat(string $nomCat): self
    {
        $this->nomCat = $nomCat;

        return $this;
    }

    public function getLibelleCat(): ?string
    {
        return $this->libelleCat;
    }

    public function setLibelleCat(?string $libelleCat): self
    {
        $this->libelleCat = $libelleCat;

        return $this;
    }

    public function getIdCat1(): ?self
    {
        return $this->idCat1;
    }

    public function setIdCat1(?self $idCat1): self
    {
        $this->idCat1 = $idCat1;

        return $this;
    }


}
