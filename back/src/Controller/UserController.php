<?php

namespace App\Controller;

use App\Entity\FavoriteGame;
use App\Entity\User;
use App\Repository\FavoriteGameRepository;
use App\Repository\GameRepository;
use App\Repository\RankRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("api/user", name="user_")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/list", name="list", methods={"POST"})
     */
    public function userList(UserRepository $userRepository)
    {
        
        $users = $userRepository->findAll();
       
        $arrayUsers = [];
        foreach ($users as  $user) {
            $arrayUsers [] = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'firstname'=> $user->getFirstname(),
                'lastname'=> $user->getLastname(),
                'birth' => $user->getBirth(),
                'email' => $user->getEmail(),
                'city' => $user->getCity(),
                'mobile' => $user->getMobile(),
                'avatar' => $user->getAvatar(),        
            ];
        }
        
        return $this->json(['all_user' => $arrayUsers]);     
        

    }




    /**
     * @Route("/selected/show", name="show", methods={"POST"})
     */
    public function userShow(Request $request, UserRepository $userRepository)
    {        

         //get data from request in json
         $gamesData = json_decode($request->getContent(), true);
        
         //get user with id
         $userSelected = $userRepository->find(['id' => $gamesData['user_id']]);
      
         
         return $this->json([
            'user_selected' => $userSelected,
            
            ], 
            200, 
            [], 
            [
                'groups' => ['login_information'],    
            ]
        );

    }




    /**
     * @Route("/add/games/favorite", name="add_games", methods={"POST"})
     */
    public function userAddFavoriteGames(Request $request, RankRepository $rankRepository, GameRepository $gameRepository)
    {
        

        //get data from request in json
        $gamesData = json_decode($request->getContent(), true);

        $user = $this->getUser();
       
        $rank = $rankRepository->findOneBy(['id' => $gamesData['rankId']]);
        $game = $gameRepository->findOneBy(['id' => $gamesData['gameId']]);


        // set informations to new instance of FavoriteGame
        $favoriteGame = new FavoriteGame;
        $favoriteGame->setUser($user);
        $favoriteGame->setRank($rank);
        $favoriteGame->setGame($game);

        
        $errors = [];
        try
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($favoriteGame);
            $entityManager->flush();

            return $this->json([
                'game_id' => $game->getId(),
                'title' => $game->getTitle(),
                'description' => $game->getDescription(),
                'poster' => $game->getPoster(),
                'logo' => $game->getLogo(),
                'rank_name' => $rank->getName(),
                'rank_id' => $rank->getId()
            ]);  
        }


        

        catch(UniqueConstraintViolationException $e)
        {
            $errors['add_game'] = "Le jeu n'a pas été rajouté, il se peut qu'il soit déjà parmi vos favoris";  
        }
        catch(\Exception $e)
        {
            $errors['add_game'] = "Le jeu n'a pas été rajouté, il se peut qu'il soit déjà parmi vos favoris";
        }
        
        // if there are errors we return them  
        return $this->json([
            $errors
        ], 400);
    }


    /**
     * @Route("/delete/games/favorite", name="delete_games", methods={"POST"})
     */
    public function userDeleteFavoriteGames(Request $request, GameRepository $gameRepository, FavoriteGameRepository $favoriteGameRepository)
    {
        
        //get data from request in json
        $gamesData = json_decode($request->getContent(), true);

        $user = $this->getUser();
        $game = $gameRepository->find(['id' => $gamesData['game_id']]);
        

        //searched for the game to delete
        $favoriteGameToDelete = $favoriteGameRepository->find(['game' => $game, 'user' => $user]);

        
        $errors = [];
        try
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($favoriteGameToDelete);
            $entityManager->flush();
            
            return $this->json([
                'success' => 'Le jeu à bien été supprimé à vos favoris',
            ]);  
        }

        catch(UniqueConstraintViolationException $e)
        {
            $errors['delete_game'] = "Le jeu n'existe pas dans les favoris";  
        }
        catch(\Exception $e)
        {
        $errors['delete_game'] = "Le jeu n'existe pas dans les favoris";
        }

        // if there are errors we return them
        return $this->json([
            $errors
        ], 400);
    }


    /**
     * @Route("/list/games/favorite", name="list_games", methods={"POST"})
     */
    public function userFavoriteGames(GameRepository $gameRepository, FavoriteGameRepository $favoriteGameRepository)
    {            
        $user = $this->getUser();   
      
        $userFavoriteGames = $favoriteGameRepository->findGamesByUser($user);

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

        if ($gamesList) {

            return $this->json(['favorite_games' => $gamesList]);

        } else {

            return $this->json(['errors' => 'la liste des favoris est vide'], 400);
        }    
    }
}



