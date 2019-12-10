<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function index()
    {  

        return $this->json(['result' => true]);
    }
    
    

    /**
     * @Route("/logout", name="api_logout", methods={"GET"} )
     */
    public function logout()
    {
    // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');    
    }
}
