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

    public function updateAgentAff($id, $matricule, $agence, $villeAgence)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->update(Agentaffagence::class, 'a')
            ->set('a.matriculeag', '?1')
            ->set('a.agence', '?2')
            ->set('a.villeagence', '?3')
            ->where('a.id = ?4')
            ->setParameter(1, $matricule)
            ->setParameter(2, $agence)
            ->setParameter(3, $villeAgence)
            ->setParameter(4, $id)
        ;
        return $q = $qb->getQuery();
        
    }

    public function insertAgentAff($matricule, $agence, $villeAgence)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->insert('admingeneachat')
            ->values(
                array(
                    'a.matriculeag' =>'?',
                    'a.agence' =>'?',
                    'a.villeagence' => '?'
                )
            )
            ->setParameter(1, $matricule)
            ->setParameter(2, $agence)
            ->setParameter(3, $villeAgence)
        ;
        return $q = $qb->getQuery();
        
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
