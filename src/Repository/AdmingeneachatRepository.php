<?php

namespace App\Repository;

use App\Entity\Admingeneachat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Admingeneachat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Admingeneachat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Admingeneachat[]    findAll()
 * @method Admingeneachat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmingeneachatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Admingeneachat::class);
    }

    public function updateAdminGene($id, $matricule)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->update(Admingeneachat::class, 'a')
            ->set('a.matriculead', '?1')
            ->where('a.id = ?2')
            ->setParameter(1, $matricule)
            ->setParameter(2, $id)
        ;
        return $q = $qb->getQuery();
    }

    // /**
    //  * @return Admingeneachat[] Returns an array of Admingeneachat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Admingeneachat
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
