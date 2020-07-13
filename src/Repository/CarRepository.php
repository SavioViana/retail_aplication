<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    
    public function getCount()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
   
   /**
    * 0 Traz as somoas dos disponiveis
    * 1 Traz as somoas dos locados
    */
    public function getCountRentail( $statusRentail = 0)
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.status = :val')
            ->setParameter('val', $statusRentail)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }


}