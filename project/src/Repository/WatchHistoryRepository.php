<?php

namespace App\Repository;

use App\Entity\WatchHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WatchHistory>
 */
class WatchHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WatchHistory::class);
    }

    public function getWatchHistoryViewsNumber(int $userId, int $mediaId): array{
        return $this->createQueryBuilder('w')
            ->andWhere('w.watcher = :userId')
            ->andWhere('w.media = :mediaId')
            ->setParameter('userId', $userId)
            ->setParameter('mediaId', $mediaId)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return WatchHistory[] Returns an array of WatchHistory objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('w.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?WatchHistory
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}