<?php

namespace App\DataFixtures;

use App\Entity\Agriculteurs;
use App\Security\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }



    public function load(ObjectManager $manager): void
    {
        $agriculteur = new Agriculteurs();
        $agriculteur->setEmail('agriculteur@gmail.com');
        $agriculteur->setTel('0781777759');
        $agriculteur->setRoles(['ROLE_USER']);

        $agriculteur->setPassword($this->userPasswordHasher->hashPassword($agriculteur, "password" ));
        

        $manager->persist($agriculteur);

        $manager->flush();
    }
}
