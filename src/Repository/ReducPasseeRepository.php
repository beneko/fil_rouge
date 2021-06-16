<?php

namespace App\Repository;

use App\Entity\ReducPassee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReducPassee|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReducPassee|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReducPassee[]    findAll()
 * @method ReducPassee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReducPasseeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReducPassee::class);
    }

    // /**
    //  * @return ReducPassee[] Returns an array of ReducPassee objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReducPassee
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
