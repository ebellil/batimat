<?php

namespace App\Repository;

use App\Entity\Materiel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Materiel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materiel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materiel[]    findAll()
 * @method Materiel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterielRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Materiel::class);
    }

    public function materielDispo(){
        return $this->createQueryBuilder('m')
            ->where('m.stock != 0')
            ->getQuery()
            ->getResult()
        ;
    }

    public function enleverQte($id, $qte)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->update(Materiel::class, 'm')
                ->set('m.stock', '?1')
                ->where('m.id = ?2')
                ->setParameter(1, $qte)
                ->setParameter(2, $id)
              
            ;
            return $q = $qb->getQuery();
    }

    // /**
    //  * @return Materiel[] Returns an array of Materiel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Materiel
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
