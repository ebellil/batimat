<?php

namespace App\Repository;

use App\Entity\Detaildemande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Detaildemande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detaildemande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detaildemande[]    findAll()
 * @method Detaildemande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetaildemandeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Detaildemande::class);
    }

    public function findByNumCommande($numCommande)
    {
      
        return $this->createQueryBuilder('detaildemande')
            ->andWhere('detaildemande.demande = :numCommande')
            ->setParameter('numCommande', $numCommande)
            ->getQuery()
            ->getResult()
        ;
    }

    

    // /**
    //  * @return Detaildemande[] Returns an array of Detaildemande objects
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
    public function findOneBySomeField($value): ?Detaildemande
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
