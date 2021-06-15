<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marques
 *
 * @ORM\Table(name="marques")
 * @ORM\Entity
 */
class Marques
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_marque", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMarque;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_marque", type="string", length=50, nullable=false)
     */
    private $nomMarque;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle_marque", type="string", length=100, nullable=true)
     */
    private $libelleMarque;

    /**
     * @var string|null
     *
     * @ORM\Column(name="logo_marque", type="string", length=255, nullable=true)
     */
    private $logoMarque;

    public function getIdMarque(): ?int
    {
        return $this->idMarque;
    }

    public function getNomMarque(): ?string
    {
        return $this->nomMarque;
    }

    public function setNomMarque(string $nomMarque): self
    {
        $this->nomMarque = $nomMarque;

        return $this;
    }

    public function getLibelleMarque(): ?string
    {
        return $this->libelleMarque;
    }

    public function setLibelleMarque(?string $libelleMarque): self
    {
        $this->libelleMarque = $libelleMarque;

        return $this;
    }

    public function getLogoMarque(): ?string
    {
        return $this->logoMarque;
    }

    public function setLogoMarque(?string $logoMarque): self
    {
        $this->logoMarque = $logoMarque;

        return $this;
    }

    public function __tostring():string{
        return $this->nomMarque;
    }

}
