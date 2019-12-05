<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;




/**
 * @Route("/api", name="api_", methods={"POST"})
 */

class LoginController extends AbstractController
{


    /**
     * @Route("/login", name="login")
     */
    public function index()
    {

        return $this->json(['result' => true]);

    }
}
