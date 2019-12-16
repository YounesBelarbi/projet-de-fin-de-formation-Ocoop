<?php

namespace App\Controller;

use App\Repository\FavoriteGameRepository;
use App\Repository\FrequencyRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;


class LoginController extends AbstractController
{    
    /**
     * @Route("user/login", name="api_login", methods={"POST"})
     */
    public function index(UserInterface $user, JWTTokenManagerInterface $JWTManager, FavoriteGameRepository $favoriteGameRepository, FrequencyRepository $frequencyRepository)
    {  
              
        // if user logged in, we generate a token
        // $token =  $JWTManager->create($user);
        $userFavoriteGames = $favoriteGameRepository->findGamesbyUser($user);
        $frequencies = $frequencyRepository->findAll();
        // dd($frequencyList);
        
        $gamesList = [];
        for ($i= 0 ; $i < count($userFavoriteGames); $i++) { 
            
            $gamesList[]= [
                'id' => $userFavoriteGames[$i]->getGame()->getId(),
                'title' => $userFavoriteGames[$i]->getGame()->getTitle(),
                'description' => $userFavoriteGames[$i]->getGame()->getDescription(),
                'poster' => $userFavoriteGames[$i]->getGame()->getPoster(),
                'logo' => $userFavoriteGames[$i]->getGame()->getLogo(),
                'rank' => $userFavoriteGames[$i]->getRank()->getName()
            ];
        }

        
        $frequencyList = [];
        for ($i= 0 ; $i < count($frequencies); $i++) {

            $frequencyList[] = [
                'id' => $frequencies[$i]->getId(),
                'name' => $frequencies[$i]->getName(),
            ];
        }


        // we send in informations in json
        return $this->json([
            'user' => $user,
            'user_frequency' => ['frequency' => $user->getFrequency()->getName()],
            'favorite_games' => $gamesList,
            'token' => $JWTManager->create($user),
            'frequency_list' => $frequencyList
            ], 
            200, 
            [], 
            [
                'groups' => ['login_information'],
            ]
        );
    } 


    /**
     * @Route("api/user/tokencheck", name="check", methods={"POST"})
     */
    public function checkToken(UserInterface $user, FavoriteGameRepository $favoriteGameRepository)
    {  

        $userFavoriteGames = $favoriteGameRepository->findGamesbyUser($user);
        $gamesList = [];
        

        for ($i= 0 ; $i < count($userFavoriteGames); $i++) { 
            
            $gamesList[]= [
                'game_id' => $userFavoriteGames[$i]->getGame()->getId(),
                'title' => $userFavoriteGames[$i]->getGame()->getTitle(),
                'description' => $userFavoriteGames[$i]->getGame()->getDescription(),
                'poster' => $userFavoriteGames[$i]->getGame()->getPoster(),
                'logo' => $userFavoriteGames[$i]->getGame()->getLogo(),
                'rank' => $userFavoriteGames[$i]->getRank()->getName()
            ];
        }
     
        return $this->json([
            'user' => $user,
            'favorite_games' => $gamesList,
            
            ], 
            200, 
            [], 
            [
                'groups' => ['login_information'],
                
            ]
        );
    } 
}







