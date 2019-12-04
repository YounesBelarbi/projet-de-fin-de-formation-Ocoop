<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\FavoriteGameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FavoriteGameController extends AbstractController
{
    /**
     * @Route("/favorite/game/{id}", name="favorite_game")
     */
    public function index(FavoriteGameRepository $favoriteGameRepository)
    {
        $favoriteGames = $favoriteGameRepository->find();
        $arrayFavoriteGames = [];
        foreach ($favoriteGames as  $favoriteGame) {
            $arrayFavoriteGames [] = [
                'game' => $favoriteGame->getGame(),
                'rank' => $favoriteGame->getRank(),
                'user' => $favoriteGame->getUser(),
                'url' => $this->generateUrl('favorite_game', [
                    'id' => $favoriteGame->getUser()->getId()
                ], UrlGeneratorInterface::ABSOLUTE_URL)
            ];
            
        }
        
        return $this->json($arrayFavoriteGames);
    }
}