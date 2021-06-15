<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity
 */
class Pays
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pays", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPays;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_pays", type="string", length=70, nullable=false)
     */
    private $nomPays;

    public function getIdPays(): ?int
    {
        return $this->idPays;
    }

    public function getNomPays(): ?string
    {
        return $this->nomPays;
    }

    public function setNomPays(string $nomPays): self
    {
        $this->nomPays = $nomPays;

        return $this;
    }


}
