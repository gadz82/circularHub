<?php

namespace App\Repository;

use App\Entity\TopicCommentAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TopicCommentAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method TopicCommentAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method TopicCommentAttachment[]    findAll()
 * @method TopicCommentAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopicCommentAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TopicCommentAttachment::class);
    }

    // /**
    //  * @return TopicCommentAttachment[] Returns an array of TopicCommentAttachment objects
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
    public function findOneBySomeField($value): ?TopicCommentAttachment
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
