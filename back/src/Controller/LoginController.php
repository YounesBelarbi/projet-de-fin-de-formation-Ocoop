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
        
        $token = new JsonResponse(['token' => $JWTManager->create($user)]);

        return $this->json(['result' => true, 'user' => $this->getUser(), 'token' => $token]);

     

        


    }
    
}
