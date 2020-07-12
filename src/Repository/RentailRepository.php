<?php

namespace App\Repository;

use App\Entity\Rentail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rentail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rentail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rentail[]    findAll()
 * @method Rentail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rentail::class);
    }

    // /**
    //  * @return Rentail[] Returns an array of Rentail objects
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
    public function findOneBySomeField($value): ?Rentail
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
