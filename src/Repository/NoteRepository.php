<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Note::class);
    }

    public function findByFournisseur($idF)
    {
      
        return $this->createQueryBuilder('note')
            ->andWhere('note.fournisseur = :idF')
            ->setParameter('idF', $idF)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByFandU($idF, $idU)
    {
      
        return $this->createQueryBuilder('note')
            ->andWhere('note.fournisseur = :idF')
            ->andWhere('note.admingeneral = :idU')
            ->setParameter('idF', $idF)
            ->setParameter('idU', $idU)
            ->getQuery()
            ->getResult()
        ;
    }

    public function updateNote($idF, $idU, $note)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->update(Note::class, 'n')
            ->set('n.note', '?1')
            ->andWhere('n.fournisseur = ?2')
            ->andWhere('n.admingeneral = ?3')
            ->setParameter(1, $note)
            ->setParameter(2, $idF)
            ->setParameter(3, $idU)
        ;
       return $q = $qb->getQuery();
    }


    // /**
    //  * @return Note[] Returns an array of Note objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Note
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
