<?php

namespace App\Repository;

use App\Entity\Demandematerielrapport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Demandematerielrapport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Demandematerielrapport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Demandematerielrapport[]    findAll()
 * @method Demandematerielrapport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandematerielrapportRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Demandematerielrapport::class);
    }

    // /**
    //  * @return Demandematerielrapport[] Returns an array of Demandematerielrapport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Demandematerielrapport
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
