<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    // public function setGamesInDataBase()
    // {
    //     $conn = $this->getEntityManager()
    //         ->getConnection();
    //     $sql = `INSERT INTO \`game\` (\`id\`, \`title\`, \`description\`, \`poster\`, \`logo\`, \`created_at\`, \`updated_at\`) VALUES
    //     (1, 'CS:GO', 'Counter-Strike: Global Offensive est un jeu de tir à la première personne multijoueur en ligne basé sur le jeu d\'équipe développé par Valve Corporation. Il est sorti le 21 août 2012 sur PC et consoles. En 2017, Microsoft annonce que le jeu sur Xbox 360 sera compatible avec la Xbox One.', 'cs-go.jpg', '', '2019-12-13 15:21:37', '2019-12-16 00:00:00'),
    //     (2, 'Overwatch', 'Overwatch est un jeu vidéo de tir en vue subjective, en équipes, en ligne, développé et publié par Blizzard Entertainment. Le jeu est annoncé le 7 novembre 2014 à la BlizzCon, et est commercialisé le 24 mai 2016 sur Windows, PlayStation 4 et Xbox One et le 15 octobre 2019 sur Nintendo Switch.', 'overwatch.jpg', '', '2019-12-13 15:21:37', NULL),
    //     (3, 'PUBG', 'PlayerUnknown\'s Battlegrounds est un jeu vidéo multijoueur en ligne de type battle royale développé et édité par PUBG Corporation, une filiale de l\'éditeur Krafton Game Union. Il est disponible en accès anticipé sur Microsoft Windows à partir du 23 mars 2017, et la version 1.0 du jeu est sortie le 20 décembre 2017.', 'pubg.jpg', '', '2019-12-13 15:21:37', NULL),
    //     (4, 'Apex Legends', 'Apex Legends est un jeu vidéo de type battle royale développé par Respawn Entertainment et édité par Electronic Arts. Il est publié en accès gratuit le 4 février 2019 sur Microsoft Windows, PlayStation 4 et Xbox One.', 'apex.jpg', '', '2019-12-13 15:21:37', NULL),
    //     (5, 'League of Legends', 'League of Legends, anciennement nommé League of Legends: Clash of Fates est un jeu vidéo de type arène de bataille en ligne gratuit développé et édité par Riot Games sur Windows et Mac OS X.', 'league-of-legends.jpg', '', '2019-12-13 15:21:37', NULL);`;
        
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute();
    //     $stmt->fetchAll();
    // }

    // /**
    //  * @return Game[] Returns an array of Game objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Game
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
