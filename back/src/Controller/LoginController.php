<?php

namespace App\Controller;

use App\Repository\FavoriteGameRepository;
use App\Repository\FrequencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AuthenticatorInterface;

class LoginController extends AbstractController
{    
    
    /**
     * @Route("user/login", name="api_login", methods={"POST"})
     */
    public function index(UserInterface $user, JWTTokenManagerInterface $JWTManager, FavoriteGameRepository $favoriteGameRepository, FrequencyRepository $frequencyRepository)
    {      
        // when user is connected status setted on true
        $user->setStatus(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // if user logged in, we generate a token
        // $token =  $JWTManager->create($user);
        $userFavoriteGames = $favoriteGameRepository->findGamesbyUser($user);
        $frequencies = $frequencyRepository->findAll();
        // dd($frequencyList);
        
        $gamesList = [];
        for ($i= 0 ; $i < count($userFavoriteGames); $i++) { 
            
            $gamesList[]= [
                'game_id' => $userFavoriteGames[$i]->getGame()->getId(),
                'title' => $userFavoriteGames[$i]->getGame()->getTitle(),
                'description' => $userFavoriteGames[$i]->getGame()->getDescription(),
                'poster' => $userFavoriteGames[$i]->getGame()->getPoster(),
                'logo' => $userFavoriteGames[$i]->getGame()->getLogo(),
                'rank_name' => $userFavoriteGames[$i]->getRank()->getName(),
                'rank_id' => $userFavoriteGames[$i]->getRank()->getId()
            ];
        }


        //if frequency usernot null we send 
        $userFrequency = "";
        if ($user->getFrequency()) {
            $userFrequency =  $user->getFrequency()->getName();
        }



        //set all frequencies
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
            'user_frequency' => $userFrequency,
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
    public function checkToken(UserInterface $user, FavoriteGameRepository $favoriteGameRepository,  FrequencyRepository $frequencyRepository)
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
                'rank_name' => $userFavoriteGames[$i]->getRank()->getName(),
                'rank_id' => $userFavoriteGames[$i]->getRank()->getId()
            ];
        }

        //get the user frequency
        //if frequency usernot null we send 
        $userFrequency = "";
        if ($user->getFrequency()) {
            $userFrequency =  $user->getFrequency()->getName();
        }

        //set all frequencies
        $frequencies = $frequencyRepository->findAll();
        $frequencyList = [];
        for ($i= 0 ; $i < count($frequencies); $i++) {

            $frequencyList[] = [
                'id' => $frequencies[$i]->getId(),
                'name' => $frequencies[$i]->getName(),
            ];
        }
     
        return $this->json([
            'user' => $user,
            'user_frequency' => $userFrequency,
            'favorite_games' => $gamesList,
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
      * @Route("api/user/logout", name="logout", methods={"POST"})
      */
    public function logout(UserInterface $user)
    {
        // when user logs out status setted on false
        $user->setStatus(false);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->json([
            'logout' => 'success'
        ]);
    }
}
    











