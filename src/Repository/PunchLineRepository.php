<?php

namespace App\Repository;

use App\Entity\PunchLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PunchLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method PunchLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method PunchLine[]    findAll()
 * @method PunchLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PunchLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PunchLine::class);
    }

    // /**
    //  * @return PunchLine[] Returns an array of PunchLine objects
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
    public function findOneBySomeField($value): ?PunchLine
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
