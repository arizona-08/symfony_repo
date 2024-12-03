<?php

namespace App\Repository;

use App\Entity\PlaylistSubscription;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaylistSubscription>
 */
class PlaylistSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaylistSubscription::class);
    }

       /**
        * @return PlaylistSubscription[] Returns an array of PlaylistSubscription objects
        */
       public function findBySubscriber(User $user): array
       {
           return $this->createQueryBuilder('p')
               ->andWhere('p.subscriber = :val')
               ->setParameter('val', $user)
               ->orderBy('p.id', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }

    //    public function findOneBySomeField($value): ?PlaylistSubscription
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}