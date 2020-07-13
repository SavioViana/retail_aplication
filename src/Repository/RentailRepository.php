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


    public function getStatusCar($value)
    {
        $qb =  $this->createQueryBuilder('r')
        ->where("r.car = :val")
        ->andWhere('r.status = 1')
        ->setParameter('val', $value)
        ->getQuery()
        ->getResult();

        if ( count($qb) >= 1 ) {
            return 'Locado';
        } else {
            return 'Disponivel';
        }
        return count($qb);
    }

    public function getCurrentRentails($value)
    {
        return $this->createQueryBuilder('r')
            ->where("r.client = :val")
            ->andWhere("r.date_devolution is NULL")
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

}
