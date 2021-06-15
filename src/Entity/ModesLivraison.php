<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModesLivraison
 *
 * @ORM\Table(name="modes_livraison")
 * @ORM\Entity
 */
class ModesLivraison
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_mode_liv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idModeLiv;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_mode_liv", type="string", length=50, nullable=false)
     */
    private $nomModeLiv;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_liv", type="string", length=255, nullable=false)
     */
    private $libelleLiv;

    /**
     * @var int
     *
     * @ORM\Column(name="delai_moy_liv", type="integer", nullable=false)
     */
    private $delaiMoyLiv;

    public function getIdModeLiv(): ?int
    {
        return $this->idModeLiv;
    }

    public function getNomModeLiv(): ?string
    {
        return $this->nomModeLiv;
    }

    public function setNomModeLiv(string $nomModeLiv): self
    {
        $this->nomModeLiv = $nomModeLiv;

        return $this;
    }

    public function getLibelleLiv(): ?string
    {
        return $this->libelleLiv;
    }

    public function setLibelleLiv(string $libelleLiv): self
    {
        $this->libelleLiv = $libelleLiv;

        return $this;
    }

    public function getDelaiMoyLiv(): ?int
    {
        return $this->delaiMoyLiv;
    }

    public function setDelaiMoyLiv(int $delaiMoyLiv): self
    {
        $this->delaiMoyLiv = $delaiMoyLiv;

        return $this;
    }


}
