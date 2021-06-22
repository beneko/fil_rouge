<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Test\AssertingContextualValidatort;
use Symfony\Component\Validator\Constraints\Regex;


/**
 * @ORM\Table(name="Utilisateurs", indexes={@ORM\Index(name="nom_pays", columns={"nom_pays"})})
 * * @ORM\Table(name="Utilisateurs", indexes={@ORM\Index(name="nom_role", columns={"nom_role"})})
 * @ORM\Entity(repositoryClass=UtilisateursRepository::class)
 */
class Utilisateurs implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $mail;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Veuillez renseigner ce champ"
     * )
     * @Assert\Regex(
     *     pattern="//",
     *     message="Caratère(s) non valide(s)"
     * )
     */

    private $mot_de_passe;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Veuillez renseigner ce champ"
     * )
     * @Assert\Regex(
     *     pattern="//",
     *     message="Caratère(s) non valide(s)"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Veuillez renseigner ce champ"
     * )
     * @Assert\Regex(
     *     pattern="//",
     *     message="Caratère(s) non valide(s)"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Veuillez renseigner ce champ"
     * )
     * @Assert\Regex(
     *     pattern="//",
     *     message="Caratère(s) non valide(s)"
     * )
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Veuillez renseigner ce champ"
     * )
     * @Assert\Regex(
     *     pattern="//",
     *     message="Caratère(s) non valide(s)"
     * )
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Veuillez renseigner ce champ"
     * )
     * @Assert\Regex(
     *     pattern="//",
     *     message="Caratère(s) non valide(s)"
     * )
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="//",
     *     message="Caratère(s) non valide(s)"
     * )
     */
    private $adresse;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *  @Assert\Regex(
     *     pattern="//",
     *     message="Caratère(s) non valide(s)"
     * )
     */
    private $date_naissance;

    /**
     * @ORM\ManyToOne(targetEntity="Pays")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pays_id", referencedColumnName="id")
     * })
     * @Assert\NotBlank(
     *     message="Veuillez renseigner ce champ"
     * )
     *  @Assert\Regex(
     *     pattern="//",
     *     message="Caratère(s) non valide(s)"
     * )
     */
    private $id_pays_id;

    /**
     * @ORM\ManyToOne(targetEntity="Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_role_id", referencedColumnName="id")
     * })
     *  @Assert\Regex(
     *     pattern="//",
     *     message="Caratère(s) non valide(s)"
     * )
     *
     */
    private $id_role_id;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->mail;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        if ($this->getIdRoleId() == "2") {
            return ["ROLE_ADMIN"];
        } elseif ($this->getIdRoleId() == "1") {
            return ["ROLE_USER"];
        } else {
            return ["ROLE_USER"];
        }
    }

    public function setRoles(): array
    {
        return [$this->setIdRoleId($this->id_role_id)];
    }

    public function getIdRoleId(): ?roles
    {
        return $this->id_role_id;

    }

    public function setIdRoleId(?roles $id_role_id): int
    {
        $this->id_role_id = $id_role_id;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->getMotDePasse();
    }

    public function setPassword(string $mot_de_passe): self
    {
        return $this->setMotDePasse();
    }

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): self
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
        $this->mot_de_passe = null;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
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
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPaysId()
    {
        return $this->id_pays_id;
    }

    /**
     * @param mixed $id_pays
     */
    public function setIdPaysId($id_pays): self
    {
        $this->id_pays_id = $id_pays;
        return $this;
    }
}
