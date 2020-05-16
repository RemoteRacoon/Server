<?php

namespace App\Repository;

use App\Entity\EducationCenter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EducationCenter|null find($id, $lockMode = null, $lockVersion = null)
 * @method EducationCenter|null findOneBy(array $criteria, array $orderBy = null)
 * @method EducationCenter[]    findAll()
 * @method EducationCenter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EducationCenterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EducationCenter::class);
    }

    // /**
    //  * @return EducationCenter[] Returns an array of EducationCenter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EducationCenter
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
