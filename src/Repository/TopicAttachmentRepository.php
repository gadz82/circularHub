<?php

namespace App\Repository;

use App\Entity\TopicAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TopicAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method TopicAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method TopicAttachment[]    findAll()
 * @method TopicAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopicAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TopicAttachment::class);
    }

    // /**
    //  * @return TopicAttachment[] Returns an array of TopicAttachment objects
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
    public function findOneBySomeField($value): ?TopicAttachment
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
