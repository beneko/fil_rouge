<?php

namespace App\Repository;

use App\Entity\LigCom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LigCom|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigCom|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigCom[]    findAll()
 * @method LigCom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigComRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigCom::class);
    }

    // /**
    //  * @return LigCom[] Returns an array of LigCom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LigCom
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
