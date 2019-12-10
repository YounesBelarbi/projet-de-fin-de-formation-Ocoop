<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

/**
 * @Route("/user", name="api_")
 */
class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function index(UserInterface $user, JWTTokenManagerInterface $JWTManager)
    {  

        //if user logged in, we generate a token
        $token = new JsonResponse(['token' => $JWTManager->create($user)]);
        

        // we send in informations in json
        return $this->json([
            'user' => $this->getUser()
         ], 
         200, 
         [], 
         [
            'groups' => ['login_information'],
            'token' => $token
         ]
      );


    }
    
}
