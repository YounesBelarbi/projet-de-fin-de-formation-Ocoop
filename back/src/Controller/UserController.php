<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/api", name="api_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/user/list", name="user_list")
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
                //'birth' => $user->getBirth(),
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
     * @Route("/user/{id}", name="user_show")
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
    * @Route("/login", name="login")
    */
    public function login()
    {
        return $this->json(['result' => true]);

    }



    /**
    * @Route("/profile/{id}", name="profile")
    *@IsGranted("ROLE_USER")
    */
    public function profile()
    {
     return $this->json([
       'user' => $this->getUser()
    ]);

    }
}



