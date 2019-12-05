<?php

namespace App\Controller;

use App\Entity\Frequency;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{


    /**
     * @Route("/api/register", name="api_register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // $data = $request->getContent();

        $arrayData = json_decode($request->getContent(), true);



        // create new user and get informtions from request json
        $user = new User();

        $username               = $arrayData['username'];
        $birth                  = \DateTime::createFromFormat('Y-m-d H:i:s', $arrayData['birth'].' 00:00:00');
        $email                  = $arrayData['email'];
        $password               = $arrayData['password'];
        $passwordConfirmation   = $arrayData['password_confirmation'];
       
        
        
        // test password
        $errors = [];
        if ($password != $passwordConfirmation) {
            $errors['password_confirmation'] = "Les mots de passe doivent être identiques.";
        }
        
        if (strlen($password) < 6) {
           $errors['password'] = "Le mot de passe doit contenir au moins 6 caractères.";

        }
        
  
        // if we have no error we register the user
        if (!$errors) {
            
            $encodedPassword = $passwordEncoder->encodePassword($user, $password);
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setBirth($birth);
            $user->setPassword($encodedPassword);
            $user->setCreatedAt(new \DateTime());


            // test for fields that must be unique
           try
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->json([
                    'success' => 'success'
                ]);  
            }

            catch(UniqueConstraintViolationException $e)
            {
                $errors['userName'] = "Email ou username déjà utilisé.";  
            }
        }

        // in case of an error we return 400
        return $this->json([
            $errors
        ], 400);
    }
}
