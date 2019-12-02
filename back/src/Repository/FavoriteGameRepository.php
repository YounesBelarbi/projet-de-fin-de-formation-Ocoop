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

    // /**
    //  * @return FavoriteGame[] Returns an array of FavoriteGame objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

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
