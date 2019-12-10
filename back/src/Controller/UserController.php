<?php

namespace App\Controller;

use App\Entity\FavoriteGame;
use App\Entity\User;
use App\Repository\GameRepository;
use App\Repository\RankRepository;
use App\Repository\UserRepository;
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
     * @Route("/add/games/favorite", name="add_games")
     */
    public function userAddFavoriteGames(Request $request, UserRepository $userRepository, RankRepository $rankRepository, GameRepository $gameRepository)
    {
        $gamesData = json_decode($request->getContent(), true);


        $user = $this->getUser();
        // $user = $userRepository->findOneBy(['username' => 'younes']);
        $rank = $rankRepository->findOneBy(['name' => 'Bronze']);
        $game = $gameRepository->findOneBy(['title' => 'Fortnite']);


        $favoriteGame = new FavoriteGame;
        $favoriteGame->setUser($user);
        $favoriteGame->setRank($rank);
        $favoriteGame->setGame($game);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($favoriteGame);
        $entityManager->flush();

        






        return $this->json([
            $gamesData,
        
        
         
        ]);
    }

    
}



