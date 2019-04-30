<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAdminGeneral()
    {
        $value = "ROLE_ADMINGENE";
        return $this->createQueryBuilder('user')
            ->andWhere('user.roles = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAgentAffile()
    {
        $value = "ROLE_AGENTAFF";
        return $this->createQueryBuilder('user')
            ->andWhere('user.roles = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function updateUser($id, $username, $password, $nom, $prenom)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->update(User::class, 'u')
            ->set('u.username', '?1')
            ->set('u.password', '?2')
            ->set('u.nom', '?3')
            ->set('u.prenom', '?4')
            ->where('u.id = ?5')
            ->setParameter(1, $username)
            ->setParameter(2, $password)
            ->setParameter(3, $nom)
            ->setParameter(4, $prenom)
            ->setParameter(5, $id)
        ;
       return $q = $qb->getQuery();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
