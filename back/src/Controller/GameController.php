<?php

namespace App\Controller;

use App\Repository\GameRepository;
use App\Repository\RankRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class GameController extends AbstractController
{
    /**
     * @Route("/games/list", name="games_list", methods={"POST"})
     */
    public function gameList(GameRepository $gameRepository)
    {

        $games = $gameRepository->findAll();
        
        $response = new Response;
        $arrayGames = [];

        foreach ($games as  $game) {
                $arrayGames [] = [
                    'id' => $game->getId(),
                    'title' => $game->getTitle(),
                    'description' => $game->getDescription(),
                    'poster' => $game->getPoster(),
                    'logo' => $game->getLogo(),
                ];
            }

        $response->setContent(json_encode(
            $arrayGames
        ));
        
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    } 

    /**
     * @Route("/games/ranksbygame", name="RankByGames")
     */
    public function RankByGame(Request $request, RankRepository $rankRepository, GameRepository $gameRepository)
    {

        //get data from request in json
        $gamesData = json_decode($request->getContent(), true);
        $game = $gameRepository->find(['id' => $gamesData['game_id']]);

        //search game with id
        $ranksListOfGame = $rankRepository->findRanksByGame($game);

        //get information from ranks object
        $ranksGame = [];
        for ($i= 0 ; $i < count($ranksListOfGame); $i++) { 
            
            $ranksGame []= [
                'id' => $ranksListOfGame[$i]->getId(),
                'name' => $ranksListOfGame[$i]->getName(),
            ];
        }
        
        return $this->json([
            'ranks_game' => $ranksGame,
        ]);  
    }
}
