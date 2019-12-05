<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(GameRepository $gameRepository)
    {
        return $this->render('main/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }
}
