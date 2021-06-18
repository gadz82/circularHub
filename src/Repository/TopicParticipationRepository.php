<?php

namespace App\Repository;

use App\Entity\TopicParticipation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TopicParticipation|null find($id, $lockMode = null, $lockVersion = null)
 * @method TopicParticipation|null findOneBy(array $criteria, array $orderBy = null)
 * @method TopicParticipation[]    findAll()
 * @method TopicParticipation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopicParticipationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TopicParticipation::class);
    }

    // /**
    //  * @return TopicParticipation[] Returns an array of TopicParticipation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TopicParticipation
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
