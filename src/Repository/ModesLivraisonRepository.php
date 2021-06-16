<?php

namespace App\Repository;

use App\Entity\ModesLivraison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModesLivraison|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModesLivraison|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModesLivraison[]    findAll()
 * @method ModesLivraison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModesLivraisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModesLivraison::class);
    }

    // /**
    //  * @return ModesLivraison[] Returns an array of ModesLivraison objects
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
    public function findOneBySomeField($value): ?ModesLivraison
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
