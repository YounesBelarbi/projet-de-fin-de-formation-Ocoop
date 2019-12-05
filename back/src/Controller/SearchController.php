<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends AbstractController
{
    /**
     * @Route("/game/search", name="game_search")
     */
    public function searchGame(Request $request)
    {
        $searchGameForm = $this->createForm(GameSearchType::class);
       

        return $this->render('search/game.html.twig', [
            'searchGameForm' => $searchGameForm->createView(),
        ]);
    }
}
