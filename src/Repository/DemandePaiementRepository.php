<?php

namespace App\Repository;

use App\Entity\DemandePaiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandePaiement|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandePaiement|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandePaiement[]    findAll()
 * @method DemandePaiement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandePaiementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandePaiement::class);
    }

    // /**
    //  * @return DemandePaiement[] Returns an array of DemandePaiement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DemandePaiement
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
