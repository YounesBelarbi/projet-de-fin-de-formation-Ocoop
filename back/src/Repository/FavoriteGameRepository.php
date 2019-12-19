<?php

namespace App\Repository;

use App\Entity\FavoriteGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FavoriteGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavoriteGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavoriteGame[]    findAll()
 * @method FavoriteGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoriteGameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavoriteGame::class);
    }

   
    public function findGamesByUser($user)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByGameAndRank($userGameId, $minInterval, $maxInterval)
    {
        return $this->createQueryBuilder('f')
            ->where('f.game = :userGameId')
            ->andWhere('f.rank BETWEEN :minInterval AND :maxInterval')
            ->setParameter('userGameId', $userGameId)
            ->setParameter('minInterval', $minInterval)
            ->setParameter('maxInterval', $maxInterval)
            ->addOrderBy('f.rank')
            ->getQuery()
            ->getResult()
        ; 
    }
    

    /*
    public function findOneBySomeField($value): ?FavoriteGame
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
