<?php

namespace App\Repository;

use App\Entity\MergeCommit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MergeCommit|null find($id, $lockMode = null, $lockVersion = null)
 * @method MergeCommit|null findOneBy(array $criteria, array $orderBy = null)
 * @method MergeCommit[]    findAll()
 * @method MergeCommit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MergeCommitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MergeCommit::class);
    }

    // /**
    //  * @return MergeCommit[] Returns an array of MergeCommit objects
    //  */
    public static function findByExampleField()
    {
        return $this->createQueryBuilder('m')
            ->select('*')
            // ->andWhere('m.exampleField = :val')
            // ->setParameter('val', $value)
            // ->orderBy('m.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?MergeCommit
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
