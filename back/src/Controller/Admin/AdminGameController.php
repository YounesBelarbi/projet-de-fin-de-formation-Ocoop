<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use App\Repository\GameRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/games", name="admin_games_")
 */
class AdminGameController extends AbstractController
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
     * @Route("/new", name="new", methods={"POST"})
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

    /**
     * @Route("/edit/{id}", name="edit", methods={"POST"})
     */
    public function edit(Request $request, Game $game, EntityManagerInterface $em): Response
    {
        $title=$request->request->get('title');
        $description=$request->request->get('description');
        $poster=$request->request->get('poster');
        $logo=$request->request->get('logo');


        $update = New DateTime();

        $game->setTitle($title);
        $game->setDescription($description);
        $game->setPoster($poster);
        $game->setLogo($logo);
        $game->setUpdatedAt($update);

        $em->flush(); 
        
        $response = new Response(
            $game,
            Response::HTTP_OK,
            ['content-type' => 'json']
        );
        return $response;
    }

    /**
    * @Route("/delete/{id}", name="delete", methods={"POST"})
    */
    public function delete(Game $game, EntityManagerInterface $em)
    {
        //this function dont work for the moment because integrity constraint
        $em->remove($game);
        $em->flush();
        $response = new Response(
            Response::HTTP_OK
        );
        return $response;
    }

    
    
}

