<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateurs
 *
 * @ORM\Table(name="utilisateurs", indexes={@ORM\Index(name="id_role", columns={"id_role"}), @ORM\Index(name="id_pays", columns={"id_pays"})})
 * @ORM\Entity
 */
class Utilisateurs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUtilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var int|null
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=true)
     */
    private $codePostal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=true)
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var \Pays
     *
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pays", referencedColumnName="id_pays")
     * })
     */
    private $idPays;

    /**
     * @var \Roles
     *
     * @ORM\ManyToOne(targetEntity="Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_role", referencedColumnName="id_role")
     * })
     */
    private $idRole;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Reduction", inversedBy="idUtilisateur")
     * @ORM\JoinTable(name="reduc_passee",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id_utilisateur")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_reduc", referencedColumnName="id_reduc")
     *   }
     * )
     */
    private $idReduc;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idReduc = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(?int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

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

    public function getIdRole(): ?Roles
    {
        return $this->idRole;
    }

    public function setIdRole(?Roles $idRole): self
    {
        $this->idRole = $idRole;

        return $this;
    }

    /**
     * @return Collection|Reduction[]
     */
    public function getIdReduc(): Collection
    {
        return $this->idReduc;
    }

    public function addIdReduc(Reduction $idReduc): self
    {
        if (!$this->idReduc->contains($idReduc)) {
            $this->idReduc[] = $idReduc;
        }

        return $this;
    }

    public function removeIdReduc(Reduction $idReduc): self
    {
        $this->idReduc->removeElement($idReduc);

        return $this;
    }

}
