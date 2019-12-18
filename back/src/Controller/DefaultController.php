<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlatformRepository;
use App\Repository\GameRepository;



class DefaultController extends AbstractController
{
    /**
     * @Route("/{reactRouting}", name="home", defaults={"reactRouting": null})
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    // /**
    //  * @Route("/adding/data", name="request")
    //  */
    // public function setData(PlatformRepository $platformRepository, GameRepository $gameRepository)
    // {
    //     $platformRepository->setPlatformInDataBase();
    //     $gameRepository->setGamesInDataBase();
    // }
}