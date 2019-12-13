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
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


/**
 * @Route("api/user", name="user_")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/list", name="list")
     */
    public function userList(UserRepository $userRepository)
    {
        
        $users = $userRepository->findAll();
        //dump(findAll());
        $arrayUsers = [];
        foreach ($users as  $user) {
            $arrayUsers [] = [
                'username' => $user->getUsername(),
                // 'roles' => $user->getRoles(),
                // 'password'=> $user->getPassword(),
                //'firstname'=> $user->getFirstname(),
                //'lastname'=> $user->getLastname(),
                'birth' => $user->getBirth(),
                //'email' => $user->getEmail(),
                'city' => $user->getCity(),
                //'longitude' => $user->getLongitude(),
                //'latitude' => $user->getLatitude(),
                // 'mobile' => $user->getMobile(),
                'avatar' => $user->getAvatar(),
                // 'created_at' => $user->getCreatedAt(),
                // 'updated_at' => $user->getUpdatedAt(),
                'url' => $this->generateUrl('user_list', [
                    'id' => $user->getId()
                ], UrlGeneratorInterface::ABSOLUTE_URL)
            ];
        }
        
        return $this->json($arrayUsers);             
    }



    /**
     * @Route("/{id}", name="show")
     */
    public function userShow(User $user, UserRepository $userRepository)
    {        
        $user = $userRepository->findById($user);
        
        $arrayUser = [];
        foreach ($user as  $user) {
            $arrayUser [] = [
                'username' => $user->getUsername(),
                // 'roles' => $user->getRoles(),
                'password'=> $user->getPassword(),
                'firstname'=> $user->getFirstname(),
                'lastname'=> $user->getLastname(),
                'birth' => $user->getBirth(),
                'email' => $user->getEmail(),
                'city' => $user->getCity(),
                // 'longitude' => $user->getLongitude(),
                // 'latitude' => $user->getLatitude(),
                'mobile' => $user->getMobile(),
                'avatar' => $user->getAvatar(),
                // 'created_at' => $user->getCreatedAt(),
                // 'updated_at' => $user->getUpdatedAt(),
                'url' => $this->generateUrl('user_show', [
                    'id' => $user->getId()
                ], UrlGeneratorInterface::ABSOLUTE_URL)
            ];
        }
        // dump($user->getUsername());
            
        return $this->json($arrayUser);
    }




     /**
     * @Route("/add/games/favorite", name="add_games", methods={"POST"})
     */
    public function userAddFavoriteGames(Request $request, RankRepository $rankRepository, GameRepository $gameRepository)
    {
        

        //get data from request in json
        $gamesData = json_decode($request->getContent(), true);

        $user = $this->getUser();
       
        $rank = $rankRepository->findOneBy(['name' => $gamesData['name']]);
        $game = $gameRepository->findOneBy(['title' => $gamesData['title']]);


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
                'success' => 'Le jeu à bien été rajouté à vos favoris',
                
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
        $game = $gameRepository->findOneBy(['title' => $gamesData['title']]);
        

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
    public function userFavoriteGames(Request $request, GameRepository $gameRepository, FavoriteGameRepository $favoriteGameRepository)
    {
        
        //get data from request in json
       

        $user = $this->getUser();
    
        
        $userFavoriteGames = $favoriteGameRepository->findGamesbyUser($user);
         

        $gamesList = [];
        $indice=1;

        for ($i= 0 ; $i < count($userFavoriteGames); $i++) { 
            

            $gamesList['favorite_game'][]= [
                'title' => $userFavoriteGames[$i]->getGame()->getTitle(),
                'description' => $userFavoriteGames[$i]->getGame()->getDescription(),
                'poster' => $userFavoriteGames[$i]->getGame()->getPoster(),
                'logo' => $userFavoriteGames[$i]->getGame()->getLogo(),
                'rank' => $userFavoriteGames[$i]->getRank()->getName()
            ];

            $indice++;
        }



        if ($gamesList) {

            return $this->json($gamesList);

        } else {

            return $this->json(['errors' => 'la liste des favoris est vide'], 400);
        }
      


    }
}



