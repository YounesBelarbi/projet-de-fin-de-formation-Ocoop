<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


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
        
        $response = new Response;
        $arrayGames = [];

        foreach ($games as  $game) {
                $arrayGames [] = [
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
     * @Route("/{id}", name="showById", methods={"GET"})
     */
    public function showById(GameRepository $gameRepository, $id): Response
    {

    
        $game = $gameRepository->find($id);

        $response = new Response;
        $arrayGame = [];
        

        
                $arrayGame [] = [
                    'title' => $game->gettitle(),
                    'description' => $game->getDescription(),
                    'poster' => $game->getPoster(), 
                    'logo' => $game->getLogo(),

                ];
            

            $response->setContent(json_encode(
                $arrayGame
            ));        
            $response->headers->set('Content-Type', 'application/json');
            
            ;
            return $response;

    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {

        $arrayData = json_decode($request->getContent(), true);

        $game = new Game;
        $game->setTitle($arrayData['title']);
        $game->setDescription($arrayData['description']);
        $game->setPoster($arrayData['poster']);
        $game->setLogo($arrayData['logo']);

       

        $em->persist($game);
        $em->flush();


        return $this->json([
            'good' => $arrayData
        ]);
    }

    
    
}

