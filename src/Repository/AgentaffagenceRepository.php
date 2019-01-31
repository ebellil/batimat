<?php

namespace App\Repository;

use App\Entity\Agentaffagence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Agentaffagence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agentaffagence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agentaffagence[]    findAll()
 * @method Agentaffagence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgentaffagenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Agentaffagence::class);
    }

    // /**
    //  * @return Agentaffagence[] Returns an array of Agentaffagence objects
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
    public function findOneBySomeField($value): ?Agentaffagence
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
