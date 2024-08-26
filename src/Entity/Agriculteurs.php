<?php

namespace App\Entity;

use App\Repository\AgriculteursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AgriculteursRepository::class)]
class Agriculteurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getAgriculteurs"])]
    private ?int $id = null;
    
    
    
    #[Groups(["getAgriculteurs"])]
    #[ORM\Column]
    
    private $email = null;
    
    // /**
    //  * @var list<string> The user roles
    //  */
    // #[ORM\Column]
    // private array $roles = [];
    
    /**
     * @var string The hashed password
     */
    #[Groups(["getAgriculteurs"])]
    #[ORM\Column]
    private $password = null;
    
    #[Groups(["getAgriculteurs"])]
    #[ORM\Column]
    private $tel = null;

    // #[ORM\Column]
    // private ?string $plainPassword = null;

    // /**
    //  * Get value of plainPassword
    //  */
    // public function getPlainPassword()
    // {
    //     return $this->plainPassword;
    // }
    // /**
    //  * Set the value
    //  * @return self
    //  */
    // public function setPlainPassword($plainPassword)
    // {
    //     $this->plainPassword = $plainPassword;
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel)
    {
        $this->tel = $tel;
        return $this;
    }
        /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }
    //     /**
    //  * @see UserInterface
    //  *
    //  * @return list<string>
    //  */
    // public function getRoles(): array
    // {
    //     $roles = $this->roles;
    //     // guarantee every user at least has ROLE_USER
    //     $roles[] = 'ROLE_AGRICULTEUR';

    //     return array_unique($roles);
    // }

    // /**
    //  * @param list<string> $roles 
    //  */
    // public function setRoles(array $roles): static
    // {
    //     $this->roles = $roles;
    //     return $this;
    // }
        /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }



}
