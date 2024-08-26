<?php

namespace App\DataFixtures;

use App\Entity\Agriculteurs;
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
        // $agriculteur->setPassword($this->userPasswordHasher->hashPassword($agriculteur, "password"));
        
        $manager->persist($agriculteur);

        $agriculteur1 = new Agriculteurs();
        $agriculteur1->setEmail('agriculteur2@gmail.com');
        $agriculteur1->setTel('0781777760');
        $agriculteur1->setPassword('password');
        
        
        // $agriculteur->setPassword($this->userPasswordHasher->hashPassword( $agriculteur, "password" ));
        // $aliment1->setStock($stock);
        // $manager->persist($aliment1);
        // $manager->persist($stock);
        
        $manager->persist($agriculteur1);
        
        $manager->flush();
    }
}
