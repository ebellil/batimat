<?php

namespace App\Repository;

use App\Entity\FournisseurRapport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FournisseurRapport|null find($id, $lockMode = null, $lockVersion = null)
 * @method FournisseurRapport|null findOneBy(array $criteria, array $orderBy = null)
 * @method FournisseurRapport[]    findAll()
 * @method FournisseurRapport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FournisseurRapportRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FournisseurRapport::class);
    }

    public function findByUser($idU)
    {
      
        return $this->createQueryBuilder('fournisseurrapport')
            ->andWhere('fournisseurrapport.admingeneral = :idU')
            ->setParameter('idU', $idU)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByFandU($idF, $idU)
    {
      
        return $this->createQueryBuilder('fournisseurrapport')
            ->andWhere('fournisseurrapport.fournisseur = :idF')
            ->andWhere('fournisseurrapport.admingeneral = :idU')
            ->setParameter('idF', $idF)
            ->setParameter('idU', $idU)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return FournisseurRapport[] Returns an array of FournisseurRapport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FournisseurRapport
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
