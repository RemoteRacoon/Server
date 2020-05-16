<?php

namespace App\Repository;

use App\Entity\RelationshipStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RelationshipStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelationshipStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelationshipStatus[]    findAll()
 * @method RelationshipStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationshipStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelationshipStatus::class);
    }

    // /**
    //  * @return RelationshipStatus[] Returns an array of RelationshipStatus objects
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
    public function findOneBySomeField($value): ?RelationshipStatus
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
