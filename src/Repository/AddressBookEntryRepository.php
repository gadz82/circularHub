<?php

namespace App\Repository;

use App\Entity\AddressBookEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AddressBookEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressBookEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressBookEntry[]    findAll()
 * @method AddressBookEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressBookEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddressBookEntry::class);
    }

    // /**
    //  * @return AddressBookEntry[] Returns an array of AddressBookEntry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AddressBookEntry
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
