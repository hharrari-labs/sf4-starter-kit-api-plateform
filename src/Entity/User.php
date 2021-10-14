<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\DateTime;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 *  @ApiResource(
 *  collectionOperations={
 *      "GET"={"access_control"="is_granted('ROLE_ADMIN')", "access_control_message"="Vous n'êtes pas autorisé à voir la liste des utilisateurs, pour cela connectez-vous en tant qu'administrateur."}, 
 *      "POST"={"validation_groups"={"postValidation"}}
 *  },
 *  itemOperations={
 *      "GET"={"access_control"="is_granted('ROLE_ADMIN') or object == user", "access_control_message"="Vous n'êtes pas autorisé à voir cet utilisateur, pour cela connectez-vous en tant qu'administrateur ou vérifier que cet utilisateur soit bien le vôtre."}, 
 *      "PUT"={"validation_groups"={"putValidation"}, "access_control"="is_granted('ROLE_ADMIN') or object == user", "access_control_message"="Vous n'êtes pas autorisé à éditer cet utilisateur, pour cela connectez-vous en tant qu'administrateur ou vérifier que cet utilisateur soit bien le vôtre."}
 *  }
 * )
 * @ORM\Entity
 * @UniqueEntity("email", message="Cet email est déjà pris par un autre utilisateur, merci de le changer !")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, minMessage="Le prénom doit faire au minimum 3 caractères", max=255, maxMessage="Le prénom doit faire au maximum 255 caractères", groups={"postValidation", "putValidation"})     * 
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, minMessage="Le nom doit faire au minimum 3 caractères", max=255, maxMessage="Le nom doit faire au maximum 255 caractères", groups={"postValidation", "putValidation"})     * 
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="L'email est obligatoire", groups={"postValidation", "putValidation"})
     * @Assert\Email(message = "L'email '{{ value }}' n'est pas valide.", groups={"postValidation", "putValidation"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom d'utilisateur est obligatoire", groups={"postValidation", "putValidation"})
     * @Assert\Length(min=3, minMessage="Le nom d'utilisateur doit faire au minimum 3 caractères", max=255, maxMessage="Le nom d'utilisateur doit faire au maximum 255 caractères", groups={"postValidation", "putValidation"})
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     * @Assert\NotBlank(message="Le rôle est obligatoire", groups={"postValidation", "putValidation"})
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le mot de passe est obligatoire", groups={"postValidation", "putValidation"})
     * @Assert\Length(min=4, minMessage="Le mot de passe doit faire au minimum 4 caractères", max=255, maxMessage="Le mot de passe doit faire au maximum 255 caractères", groups={"postValidation", "putValidation"})
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $resetToken;

    /**
     * Give the full name of user
     *
     * @return string
     */
    public function getFullName()
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function getRoleTitle()
    {
        if(in_array("ROLE_ADMIN", $this->roles)) return "Administrateur";
        else return "Utilisateur";
    }

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getId() : ? int
    {
        return $this->id;
    }

    public function getEmail() : ? string
    {
        return $this->email;
    }

    public function setEmail(string $email) : self
    {
        $this->email = $email;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getRoles() : array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles) : self
    {
        $this->roles = $roles;
        return $this;
    }

    
    public function getPassword() : string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password) : self
    {
        $this->password = $password;
        return $this;
    }
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getSalt()
    {}

    public function eraseCredentials()
    {}

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }
     
    public function setResetToken(?string $resetToken): void
    {
        $this->resetToken = $resetToken;
    }
}