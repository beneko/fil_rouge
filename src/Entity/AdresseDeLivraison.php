<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdresseDeLivraison
 *
 * @ORM\Table(name="adresse_de_livraison", indexes={@ORM\Index(name="id_pays", columns={"id_pays"}), @ORM\Index(name="id_utilisateur", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class AdresseDeLivraison
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_adrr_livr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAdrrLivr;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=70, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_livraison", type="string", length=255, nullable=false)
     */
    private $adresseLivraison;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal_liv", type="integer", nullable=false)
     */
    private $codePostalLiv;

    /**
     * @var \Utilisateurs
     *
     * @ORM\ManyToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id_utilisateur")
     * })
     */
    private $idUtilisateur;

    /**
     * @var \Pays
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pays", referencedColumnName="id_pays")
     * })
     */
    private $idPays;

    public function getIdAdrrLivr(): ?int
    {
        return $this->idAdrrLivr;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison(string $adresseLivraison): self
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    public function getCodePostalLiv(): ?int
    {
        return $this->codePostalLiv;
    }

    public function setCodePostalLiv(int $codePostalLiv): self
    {
        $this->codePostalLiv = $codePostalLiv;

        return $this;
    }

    public function getIdUtilisateur(): ?Utilisateurs
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?Utilisateurs $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    public function getIdPays(): ?Pays
    {
        return $this->idPays;
    }

    public function setIdPays(?Pays $idPays): self
    {
        $this->idPays = $idPays;

        return $this;
    }


}
