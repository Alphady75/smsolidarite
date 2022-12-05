<?php

namespace App\Repository;

use App\Entity\PaiementEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PaiementEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaiementEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaiementEmail[]    findAll()
 * @method PaiementEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaiementEmailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaiementEmail::class);
    }

    // /**
    //  * @return PaiementEmail[] Returns an array of PaiementEmail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PaiementEmail
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
