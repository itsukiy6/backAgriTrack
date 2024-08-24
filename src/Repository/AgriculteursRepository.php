<?php

namespace App\Repository;

use App\Entity\Agriculteurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @extends ServiceEntityRepository<Agriculteurs>
 */
class AgriculteursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Agriculteurs::class);
    }

    
    // public function upgradePassword(PasswordAuthenticatedUserInterface $agriculteur, string $newHashedPassword): void
    // {
    //     if (!$agriculteur instanceof Agriculteurs)
    //     {
    //         throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $agriculteur::class));

    //     }

    //     $agriculteur->setPassword($newHashedPassword);
    //     $this->getEntityManager()->persist($agriculteur);
    //     $this->getEntityManager()->flush();
    // }
    //    /**
    //     * @return Agriculteurs[] Returns an array of Agriculteurs objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Agriculteurs
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
