<?php

namespace App\Entity;

use App\Repository\AgriculteursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: AgriculteursRepository::class)]
class Agriculteurs implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getAgriculteurs"])]
    private ?int $id = null;
    
    
    
    #[Groups(["getAgriculteurs"])]
    #[ORM\Column]
    
    private $email = null;
    

    #[Groups(["getAgriculteurs"])]
    #[ORM\Column]
    private $password = null;
    
    #[Groups(["getAgriculteurs"])]
    #[ORM\Column]
    private $tel = null;


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
