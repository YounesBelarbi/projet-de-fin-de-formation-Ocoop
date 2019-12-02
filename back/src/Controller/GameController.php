<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/games", name="games_")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function gameList(GameRepository $gameRepository)
    {
        $games = $gameRepository->findAll();
        $arrayGames = [];
        foreach ($games as  $game) {
            $arrayGames [] = [
                'title' => $game->getTitle(),
                'description' => $game->getDescription(),
                'poster' => $game->getPoster(),
                'logo' => $game->getLogo(),
                'url' => $this->generateUrl('games_list', [
                    'id' => $game->getId()
                ], UrlGeneratorInterface::ABSOLUTE_URL)
            ];
        }

        return $this->json($arrayGames);             
    } 
}

