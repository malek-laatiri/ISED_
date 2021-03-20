<?php

namespace App\Repository;

use App\Entity\Uv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Uv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Uv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Uv[]    findAll()
 * @method Uv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Uv::class);
    }

    // /**
    //  * @return Uv[] Returns an array of Uv objects
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
    public function findOneBySomeField($value): ?Uv
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
